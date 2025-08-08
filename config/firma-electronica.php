<?php



return [
    'url' => env('URL_FIRMA_ELECTRONICA', 'https://signer.infile.com/api/v3/firma_documentos/firmar_documento'), // Default URL for electronic signature service
    'llave_acceso' => env('LLAVE_ACCESO_FIRMA_ELECTRONICA', '4e9d57e6d81fb00352b12760b5d265ea'), // Default key for electronic signature service
    'email' => env('EMAIL_FIRMA_ELECTRONICA', 'altamiranoesdras@gmail.com'), // Default email for electronic signature service
    'password' => env('PASSWORD_FIRMA_ELECTRONICA', 'pMNhB2McvtiHZqL'), // Default password for electronic signature service
];
