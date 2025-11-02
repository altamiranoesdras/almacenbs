<?php

return [
    'url' => env('URL_FIRMA_ELECTRONICA', 'https://signer.infile.com/api/v3/firma_documentos/firmar_documento'), // Default URL for electronic signature service
    'llave_acceso' => env('LLAVE_ACCESO_FIRMA_ELECTRONICA'), // Default key for electronic signature service
    'email' => env('EMAIL_FIRMA_ELECTRONICA'), // Default email for electronic signature service
    'password' => env('PASSWORD_FIRMA_ELECTRONICA'), // Default password for electronic signature service
    'simular_firma' => env('SIMULAR_FIRMA_ELECTRONICA', false), // Default to false, set to true for testing purposes
];
