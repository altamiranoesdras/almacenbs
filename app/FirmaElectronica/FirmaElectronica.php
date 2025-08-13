<?php

namespace App\FirmaElectronica;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FirmaElectronica
{
    // --- Configuración de salida ---
    protected string $modoSalida = 'en_linea'; // en_linea | ruta
    protected string $disco = 'local';
    protected string $directorio = 'firmados';

    // --- Parámetros de firma ---
    protected ?UploadedFile $documento = null;
    protected ?string $rutaRubricaUsuario = null;
    protected ?string $rutaRubrica = null;
    protected string $concepto = 'test';
    protected string $lugar = 'Guatemala, Guatemala';
    protected string $tipoSolicitud = 'PDF';
    protected string $aparienciaFirma = 'GRAPHIC_AND_DESCRIPTION';
    protected int $inicioX = 250;
    protected int $inicioY = 15;
    protected int $ancho = 250;
    protected int $alto = 65;
    protected int $pagina = 1;

    // --- Credenciales de la firma ---
    protected ?string $correo = null;
    protected ?string $claveFirma = null;

    // --- Cliente HTTP y archivo ---
    protected ?Client $clienteHttp = null;
    protected ?string $nombreArchivo = null;

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
    public function respuestaEnLinea(): self { $this->modoSalida = 'en_linea'; return $this; }
    public function respuestaRuta(): self    { $this->modoSalida = 'ruta'; return $this; }
    public function setDisco(string $disco): self { $this->disco = $disco; return $this; }
    public function setDirectorio(string $directorio): self { $this->directorio = trim($directorio, '/'); return $this; }

    // =========================
    // Setters de parámetros
    // =========================
    public function setDocumento(UploadedFile $archivo): self
    {
        $this->documento = $archivo;
        $this->nombreArchivo = $archivo->getClientOriginalName();
        return $this;
    }

    public function setRubricaUsuario(string $ruta): self { $this->rutaRubricaUsuario = $ruta; return $this; }
    public function setRubrica(string $ruta): self        { $this->rutaRubrica = $ruta; return $this; }
    public function setConcepto(string $concepto): self   { $this->concepto = $concepto; return $this; }
    public function setLugar(string $lugar): self         { $this->lugar = $lugar; return $this; }
    public function setTipoSolicitud(string $tipo): self  { $this->tipoSolicitud = $tipo; return $this; }
    public function setAparienciaFirma(string $apariencia): self { $this->aparienciaFirma = $apariencia; return $this; }
    public function setInicioX(int $x): self { $this->inicioX = $x; return $this; }
    public function setInicioY(int $y): self { $this->inicioY = $y; return $this; }
    public function setAncho(int $ancho): self { $this->ancho = $ancho; return $this; }
    public function setAlto(int $alto): self { $this->alto = $alto; return $this; }
    public function setPagina(int $pagina): self
    {
        if ($pagina < 1) { throw new \InvalidArgumentException('La página debe ser mayor o igual a 1.'); }
        $this->pagina = $pagina;
        return $this;
    }

    // Credenciales dinámicas
    public function setCorreo(string $correo): self { $this->correo = $correo; return $this; }
    public function setClaveFirma(string $clave): self { $this->claveFirma = $clave; return $this; }

    // =========================
    // Firma
    // =========================
    public function firmar()
    {
        $url         = config('firma-electronica.url');
        $llaveAcceso = config('firma-electronica.llave_acceso');

        if (!$url || !$llaveAcceso) {
            throw new \RuntimeException('Configuración de servicio incompleta.');
        }
        if (!$this->correo || !$this->claveFirma) {
            throw new \InvalidArgumentException('Debe establecer correo y clave de firma con setCorreo() y setClaveFirma().');
        }
        if (!$this->documento) {
            throw new \InvalidArgumentException('Debe definir un documento con setDocumento().');
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
            throw new \InvalidArgumentException('Debe definir una rúbrica con setRubrica() o setRubricaUsuario().');
        }
        $contenidoRubrica = @file_get_contents($rutaRubricaFinal);
        if ($contenidoRubrica === false) {
            throw new \RuntimeException('No se pudo leer la rúbrica.');
        }
        $rubricaB64 = base64_encode($contenidoRubrica);

        $multipart = [
            ['name' => 'llave_acceso',                        'contents' => $llaveAcceso],
            ['name' => 'email',                               'contents' => $this->correo],
            ['name' => 'password_firma',                      'contents' => $this->claveFirma],
            ['name' => 'solicitud_firma[es_sincrono]',        'contents' => 'true'],
            ['name' => 'solicitud_firma[concepto]',           'contents' => $this->concepto],
            ['name' => 'solicitud_firma[lugar]',              'contents' => $this->lugar],
            ['name' => 'solicitud_firma[tipo_solicitud]',     'contents' => $this->tipoSolicitud],
            ['name' => 'solicitud_firma[apariencia_firma]',   'contents' => $this->aparienciaFirma],
            ['name' => 'solicitud_firma[rubrica]',            'contents' => $rubricaB64],
            ['name' => 'solicitud_firma[url_respuesta]',      'contents' => ''],
            ['name' => 'solicitud_firma[cerrar]',             'contents' => 'false'],
            ['name' => 'solicitud_firma[coordenadas][][paginas]',      'contents' => (string)$this->pagina],
            ['name' => 'solicitud_firma[coordenadas][][coordenadas]',  'contents' => $coordenadas],
            ['name' => 'solicitud_firma[font_size]',          'contents' => '-2'],
            ['name' => 'solicitud_firma[show_dn]',            'contents' => 'false'],
            [
                'name'     => 'solicitud_firma[archivo]',
                'contents' => fopen($this->documento->getPathname(), 'r'),
                'filename' => $this->documento->getClientOriginalName(),
                'headers'  => [
                    'Content-Type' => $this->documento->getMimeType(),
                ],
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
