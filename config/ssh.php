<?php

return [
    'host' => env('SSH_HOST', 'direccion_servidor'),
    'port' => env('SSH_PORT', 22),
    'username' => env('SSH_USERNAME', 'usuario'),
    'password' => env('SSH_PASSWORD', ''),
    'private_key' => env('SSH_PRIVATE_KEY', base_path('.ssh/id_rsa')),
    'keyphrase' => env('SSH_KEYPHRASE', ''),
];
