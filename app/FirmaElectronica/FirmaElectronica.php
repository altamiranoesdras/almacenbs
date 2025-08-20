<?php

namespace App\FirmaElectronica;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Clase para firmar electrónicamente documentos PDF
 * mediante un servicio externo de firma electrónica.
 *
 * Permite configurar cada parámetro de la firma
 * mediante métodos set() encadenables.
 */
class FirmaElectronica
{
    /** @var string Modo de salida: en_linea (descargar) o ruta (guardar y devolver ruta) */
    protected string $modoSalida = 'en_linea';

    /** @var string Nombre del disco de almacenamiento en Laravel */
    protected string $disco = 'local';

    /** @var string Carpeta donde se guardará el archivo firmado */
    protected string $directorio = 'firmados';

    /** @var UploadedFile|null Documento PDF a firmar */
    protected ?UploadedFile $documento = null;

    /** @var string|null URL o ruta de la rúbrica del usuario */
    protected ?string $rutaRubricaUsuario = null;

    /** @var string|null URL o ruta de la rúbrica genérica */
    protected ?string $rutaRubrica = null;

    /** @var string Concepto de la firma */
    protected string $concepto = 'test';

    /** @var string Lugar de la firma */
    protected string $lugar = 'Guatemala, Guatemala';

    /** @var string Tipo de solicitud (ej. PDF) */
    protected string $tipoSolicitud = 'PDF';

    /** @var string Apariencia de la firma (ej. GRAPHIC_AND_DESCRIPTION) */
    protected string $aparienciaFirma = 'GRAPHIC_AND_DESCRIPTION';

    /** @var int Coordenada X inicial de la firma en mm */
    protected int $inicioX = 250;

    /** @var int Coordenada Y inicial de la firma en mm */
    protected int $inicioY = 15;

    /** @var int Ancho de la firma en mm */
    protected int $ancho = 250;

    /** @var int Alto de la firma en mm */
    protected int $alto = 65;

    /** @var int Página donde se colocará la firma (1 por defecto) */
    protected int $pagina = 1;

    /** @var string|null Correo asociado a la firma electrónica */
    protected ?string $correo = null;

    /** @var string|null Contraseña de la firma electrónica */
    protected ?string $claveFirma = null;

    /** @var Client|null Cliente HTTP para la conexión con el servicio */
    protected ?Client $clienteHttp = null;

    /** @var string|null Nombre del archivo original */
    protected ?string $nombreArchivo = null;

    /**
     * Constructor.
     *
     * @param Client|null $clienteHttp Cliente HTTP opcional (por defecto se crea uno nuevo)
     */
    public function __construct(?Client $clienteHttp = null)
    {
        $this->clienteHttp = $clienteHttp ?: new Client([
            'timeout'         => 60,
            'connect_timeout' => 15,
        ]);
    }

    // =========================
    // Configuración de salida
    // =========================

    /**
     * Define que la salida sea el PDF firmado en línea (descarga).
     */
    public function respuestaEnLinea(): self { $this->modoSalida = 'en_linea'; return $this; }

    /**
     * Define que la salida sea la ruta donde se guardó el archivo firmado.
     */
    public function respuestaRuta(): self    { $this->modoSalida = 'ruta'; return $this; }

    /**
     * Define el disco de almacenamiento de Laravel.
     */
    public function setDisco(string $disco): self { $this->disco = $disco; return $this; }

    /**
     * Define el directorio donde se guardará el archivo firmado.
     */
    public function setDirectorio(string $directorio): self { $this->directorio = trim($directorio, '/'); return $this; }

    // =========================
    // Setters de parámetros
    // =========================

    /** Asigna el documento PDF a firmar. */
    public function setDocumento(UploadedFile $archivo): self
    {
        $this->documento = $archivo;
        $this->nombreArchivo = $archivo->getClientOriginalName();
        return $this;
    }

    /** Asigna la ruta o URL de la rúbrica del usuario. */
    public function setRubricaUsuario(string $ruta): self { $this->rutaRubricaUsuario = $ruta; return $this; }

    /** Asigna la ruta o URL de la rúbrica genérica. */
    public function setRubrica(string $ruta): self        { $this->rutaRubrica = $ruta; return $this; }

    /** Asigna el concepto de la firma. */
    public function setConcepto(string $concepto): self   { $this->concepto = $concepto; return $this; }

    /** Asigna el lugar de la firma. */
    public function setLugar(string $lugar): self         { $this->lugar = $lugar; return $this; }

    /** Asigna el tipo de solicitud. */
    public function setTipoSolicitud(string $tipo): self  { $this->tipoSolicitud = $tipo; return $this; }

    /** Asigna la apariencia de la firma. */
    public function setAparienciaFirma(string $apariencia): self { $this->aparienciaFirma = $apariencia; return $this; }

    /** Asigna la coordenada X inicial de la firma. */
    public function setInicioX(int $x): self { $this->inicioX = $x; return $this; }

    /** Asigna la coordenada Y inicial de la firma. */
    public function setInicioY(int $y): self { $this->inicioY = $y; return $this; }

    /** Asigna el ancho de la firma. */
    public function setAncho(int $ancho): self { $this->ancho = $ancho; return $this; }

    /** Asigna el alto de la firma. */
    public function setAlto(int $alto): self { $this->alto = $alto; return $this; }

    /** Asigna el número de página donde se colocará la firma. */
    public function setPagina(int $pagina): self
    {
        if ($pagina < 1) { throw new \InvalidArgumentException('La página debe ser mayor o igual a 1.'); }
        $this->pagina = $pagina;
        return $this;
    }

    /** Asigna el correo asociado a la firma electrónica. */
    public function setCorreo(string $correo): self { $this->correo = $correo; return $this; }

    /** Asigna la clave de la firma electrónica. */
    public function setClaveFirma(string $clave): self { $this->claveFirma = $clave; return $this; }

    // =========================
    // Firma
    // =========================

    /**
     * Ejecuta el proceso de firma electrónica.
     *
     * @return Response|string PDF firmado como respuesta HTTP o ruta del archivo firmado.
     */
    public function firmarDocumento()
    {
        $url         = config('firma-electronica.url');
        $llaveAcceso = config('firma-electronica.llave_acceso');

        if (!$url || !$llaveAcceso) {
            throw new \RuntimeException('Configuración de servicio incompleta.');
        }
        if (!$this->correo || !$this->claveFirma) {
            throw new \InvalidArgumentException('Debe definir el correo y la clave de la firma.');
        }
        if (!$this->documento) {
            throw new \InvalidArgumentException('Debe asignar un documento con setDocumento().');
        }

        $coordenadas = sprintf(
            '%d %d %d %d',
            $this->inicioX,
            $this->inicioY,
            $this->inicioX + $this->ancho,
            $this->inicioY + $this->alto
        );

        $rutaRubricaFinal = $this->rutaRubricaUsuario ?? $this->rutaRubrica;
        if (!$rutaRubricaFinal) {
            throw new \InvalidArgumentException('Debe asignar una rúbrica con setRubrica() o setRubricaUsuario().');
        }
        $contenidoRubrica = @file_get_contents($rutaRubricaFinal);
        if ($contenidoRubrica === false) {
            throw new \RuntimeException('No se pudo leer la rúbrica.');
        }
        $rubricaB64 = base64_encode($contenidoRubrica);

        $multipart = [
            ['name' => 'llave_acceso', 'contents' => $llaveAcceso],
            ['name' => 'email', 'contents' => $this->correo],
            ['name' => 'password_firma', 'contents' => $this->claveFirma],
            ['name' => 'solicitud_firma[es_sincrono]', 'contents' => 'true'],
            ['name' => 'solicitud_firma[concepto]', 'contents' => $this->concepto],
            ['name' => 'solicitud_firma[lugar]', 'contents' => $this->lugar],
            ['name' => 'solicitud_firma[tipo_solicitud]', 'contents' => $this->tipoSolicitud],
            ['name' => 'solicitud_firma[apariencia_firma]', 'contents' => $this->aparienciaFirma],
            ['name' => 'solicitud_firma[rubrica]', 'contents' => $rubricaB64],
            ['name' => 'solicitud_firma[url_respuesta]', 'contents' => ''],
            ['name' => 'solicitud_firma[cerrar]', 'contents' => 'false'],
            ['name' => 'solicitud_firma[coordenadas][][paginas]', 'contents' => (string)$this->pagina],
            ['name' => 'solicitud_firma[coordenadas][][coordenadas]', 'contents' => $coordenadas],
            ['name' => 'solicitud_firma[font_size]', 'contents' => '-2'],
            ['name' => 'solicitud_firma[show_dn]', 'contents' => 'false'],
            [
                'name'     => 'solicitud_firma[archivo]',
                'contents' => fopen($this->documento->getPathname(), 'r'),
                'filename' => $this->documento->getClientOriginalName(),
                'headers'  => ['Content-Type' => $this->documento->getMimeType()],
            ],
        ];

        try {
            $respuesta = ($this->clienteHttp ?: new Client())->post($url, ['multipart' => $multipart]);
        } catch (\Throwable $e) {
            throw new \RuntimeException('Error al comunicarse con el servicio de firma: ' . $e->getMessage(), 0, $e);
        }

        $json = json_decode((string)$respuesta->getBody(), true);
        if (!is_array($json) || !($json['respuesta'] ?? false)) {
            throw new \RuntimeException($json['descripcion'] ?? 'Error desconocido al firmar.');
        }

        $pdfBin = base64_decode($json['archivo'] ?? '', true);
        if ($pdfBin === false) {
            throw new \RuntimeException('No se pudo decodificar el PDF firmado.');
        }

        $nombreBase = pathinfo($this->nombreArchivo ?? 'documento', PATHINFO_FILENAME);
        $nombreSalida = $nombreBase . '_firmado.pdf';
        $ruta = ($this->directorio ? $this->directorio . '/' : '') . $nombreSalida;

        Storage::disk($this->disco)->put($ruta, $pdfBin);

        if ($this->modoSalida === 'ruta') {
            return $ruta;
        }

        return new Response(
            $pdfBin,
            200,
            [
                'Content-Type'        => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="' . $nombreSalida . '"',
            ]
        );
    }
}
