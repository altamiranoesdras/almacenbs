<?php

namespace App\FirmaElectronica;

use data;
use Illuminate\Support\Facades\Storage;

class FirmaElectronica
{
    protected $nombre_archivo;

    public function __construct()
    {
        // You can initialize any properties or dependencies here if needed
    }

    public function firmarDocumento($data){

        $url = config('firma-electronica.url'); // Default URL for electronic signature service
        $llave_acceso = config('firma-electronica.llave_acceso'); // Default key for electronic signature
        $email = config('firma-electronica.email'); // Default email for electronic signature
        $password_firma = config('firma-electronica.password'); // Default password for electronic signature
        $concepto = $data['concepto'] ?? 'test'; // Default concept for signature data
        $lugar = $data['lugar'] ?? 'Guatemala, Guatemala'; // Default place for signature data
        $tipo_solicitud = $data['tipo_solicitud'] ?? 'PDF'; // Default type of data for signature
        $apariencia_firma = $data['apariencia_firma'] ?? 'GRAPHIC_AND_DESCRIPTION'; // Default appearance for signature

        if($data['rubrica_user']) {
            // media library es la url y hay que convertir a base64
            $rubrica = base64_encode(file_get_contents($data['rubrica_user'])) ?? '';
        } else {
            $rubrica = base64_encode(file_get_contents($data['rubrica'])) ?? ''; // Default signature appearance
        }
        $archivo = $data['documento'] ?? null; // Default document for signature
        $this->nombre_archivo = $archivo->getClientOriginalName(); // Get the original name of the file

        $inicio_x = $data['firma_inicio_x'] ?? 250; // Default starting X coordinate for signature in mm
        $inicio_y = $data['firma_inicio_y'] ?? 0; // Default starting Y coordinate for signature in mm
        $ancho = $data['firma_ancho'] ?? 300; // Default width for signature in mm
        $alto = $data['firma_alto'] ?? 75; // Default height for signature in mm

        $coordenadas = $inicio_x . ' ' . $inicio_y . ' ' . ($inicio_x + $ancho) . ' ' . ($inicio_y + $alto);

        // dd($archivo); // Debugging: dump the file data

        // Validate the data data

        $multipart = [
            ['name' => 'llave_acceso',                        'contents' => $llave_acceso],
            ['name' => 'email',                               'contents' => $email],
            ['name' => 'password_firma',                      'contents' => $password_firma],

            ['name' => 'solicitud_firma[es_sincrono]',        'contents' => 'true'],
            ['name' => 'solicitud_firma[concepto]',           'contents' => $concepto],
            ['name' => 'solicitud_firma[lugar]',              'contents' => $lugar],
            ['name' => 'solicitud_firma[tipo_solicitud]',     'contents' => $tipo_solicitud],
            ['name' => 'solicitud_firma[apariencia_firma]',   'contents' => $apariencia_firma],
            ['name' => 'solicitud_firma[rubrica]',            'contents' => $rubrica],
            ['name' => 'solicitud_firma[url_respuesta]',      'contents' => ''],
            ['name' => 'solicitud_firma[cerrar]',             'contents' => 'false'],

            // coordenadas[][paginas] y coordenadas[][coordenadas]
            ['name' => 'solicitud_firma[coordenadas][][paginas]',      'contents' => '1'],
            ['name' => 'solicitud_firma[coordenadas][][coordenadas]',  'contents' => $coordenadas],

            ['name' => 'solicitud_firma[font_size]',          'contents' => '-2'],
            ['name' => 'solicitud_firma[show_dn]',            'contents' => 'false'],

            // El archivo PDF
            [
                'name'     => 'solicitud_firma[archivo]',
                'contents' => fopen($archivo->getPathname(), 'r'),
                'filename' => $archivo->getClientOriginalName(),
                'headers'  => [
                    // Guzzle detecta el MIME, pero lo puedes fijar:
                    'Content-Type' => $archivo->getMimeType(),
                ],
            ],
        ];

        // dd($form_data); // Debugging: dump the form data

        // Send the POST data to the electronic signature service
        $client = new \GuzzleHttp\Client();
        $response = $client->post($url, [
            'multipart' => $multipart
        ]);

        $body = (string) $response->getBody();
        $data = json_decode($body, true);

        if (!($data['respuesta'] ?? false)) {
            throw new \RuntimeException($data['descripcion'] ?? 'Error desconocido');
        }

        $pdfB64 = $data['archivo'];
        $pdfBin = base64_decode($pdfB64);

        $nombre = pathinfo($this->nombre_archivo, PATHINFO_FILENAME) . '_signed.pdf';
        Storage::put('signed/' . $nombre, $pdfBin);

        return response($pdfBin, 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $nombre . '"',
        ]);

    }
}