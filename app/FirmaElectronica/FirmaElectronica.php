<?php

namespace App\FirmaElectronica;

use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FirmaElectronica
{
    protected ?string $nombreArchivo = null;
    protected string $outputMode = 'inline';   // 'inline' | 'path'
    protected string $disk = 'local';
    protected string $directory = 'signed';

    public function __construct(
        protected ?Client $http = null
    ) {
        $this->http = $http ?: new Client([
            'timeout' => 60,
            'connect_timeout' => 15,
        ]);
    }

    // --- Nuevos métodos más claros ---
    public function responseInline(): self
    {
        $this->outputMode = 'inline';
        return $this;
    }

    public function responsePath(): self
    {
        $this->outputMode = 'path';
        return $this;
    }

    public function toDisk(string $disk): self
    {
        $this->disk = $disk;
        return $this;
    }

    public function inDirectory(string $directory): self
    {
        $this->directory = trim($directory, '/');
        return $this;
    }

    public function firmarDocumento(array $data)
    {
        $url             = config('firma-electronica.url');
        $llaveAcceso     = config('firma-electronica.llave_acceso');
        $email           = config('firma-electronica.email');
        $passwordFirma   = config('firma-electronica.password');

        if (!$url || !$llaveAcceso || !$email || !$passwordFirma) {
            throw new \RuntimeException('Configuración incompleta de firma-electronica.');
        }

        $concepto         = $data['concepto']          ?? 'test';
        $lugar            = $data['lugar']             ?? 'Guatemala, Guatemala';
        $tipoSolicitud    = $data['tipo_solicitud']    ?? 'PDF';
        $aparienciaFirma  = $data['apariencia_firma']  ?? 'GRAPHIC_AND_DESCRIPTION';
        $archivo          = $data['documento']         ?? null;

        if (!$archivo) {
            throw new \InvalidArgumentException('El campo "documento" es requerido.');
        }

        $this->nombreArchivo = $archivo->getClientOriginalName();

        $inicioX = (int)($data['firma_inicio_x'] ?? 250);
        $inicioY = (int)($data['firma_inicio_y'] ?? 15);
        $ancho   = (int)($data['firma_ancho']    ?? 250);
        $alto    = (int)($data['firma_alto']     ?? 65);

        $coordenadas = sprintf(
            '%d %d %d %d',
            $inicioX,
            $inicioY,
            $inicioX + $ancho,
            $inicioY + $alto
        );

        $rubricaSrc = $data['rubrica_user'] ?? ($data['rubrica'] ?? null);
        if (!$rubricaSrc) {
            throw new \InvalidArgumentException('Se requiere "rubrica" o "rubrica_user".');
        }

        $rubricaContent = @file_get_contents($rubricaSrc);
        if ($rubricaContent === false) {
            throw new \RuntimeException('No se pudo leer la rúbrica desde la fuente proporcionada.');
        }
        $rubricaB64 = base64_encode($rubricaContent);

        $multipart = [
            ['name' => 'llave_acceso',                        'contents' => $llaveAcceso],
            ['name' => 'email',                               'contents' => $email],
            ['name' => 'password_firma',                      'contents' => $passwordFirma],
            ['name' => 'solicitud_firma[es_sincrono]',        'contents' => 'true'],
            ['name' => 'solicitud_firma[concepto]',           'contents' => $concepto],
            ['name' => 'solicitud_firma[lugar]',              'contents' => $lugar],
            ['name' => 'solicitud_firma[tipo_solicitud]',     'contents' => $tipoSolicitud],
            ['name' => 'solicitud_firma[apariencia_firma]',   'contents' => $aparienciaFirma],
            ['name' => 'solicitud_firma[rubrica]',            'contents' => $rubricaB64],
            ['name' => 'solicitud_firma[url_respuesta]',      'contents' => ''],
            ['name' => 'solicitud_firma[cerrar]',             'contents' => 'false'],
            ['name' => 'solicitud_firma[coordenadas][][paginas]',      'contents' => '1'],
            ['name' => 'solicitud_firma[coordenadas][][coordenadas]',  'contents' => $coordenadas],
            ['name' => 'solicitud_firma[font_size]',          'contents' => '-2'],
            ['name' => 'solicitud_firma[show_dn]',            'contents' => 'false'],
            [
                'name'     => 'solicitud_firma[archivo]',
                'contents' => fopen($archivo->getPathname(), 'r'),
                'filename' => $archivo->getClientOriginalName(),
                'headers'  => [
                    'Content-Type' => $archivo->getMimeType(),
                ],
            ],
        ];

        try {
            $response = $this->http->post($url, ['multipart' => $multipart]);
        } catch (\Throwable $e) {
            throw new \RuntimeException('Error al comunicarse con el servicio de firma: ' . $e->getMessage(), 0, $e);
        }

        $json = json_decode((string)$response->getBody(), true);

        if (!is_array($json) || !($json['respuesta'] ?? false)) {
            throw new \RuntimeException($json['descripcion'] ?? 'Error desconocido al firmar.');
        }

        $pdfBin = base64_decode($json['archivo'] ?? '', true);
        if ($pdfBin === false) {
            throw new \RuntimeException('No se pudo decodificar el PDF firmado.');
        }

        $nombreSalida = pathinfo($this->nombreArchivo, PATHINFO_FILENAME) . '_signed.pdf';
        $path = ($this->directory ? $this->directory . '/' : '') . $nombreSalida;

        Storage::disk($this->disk)->put($path, $pdfBin);

        if ($this->outputMode === 'path') {
            return $path;
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
