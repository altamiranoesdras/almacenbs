<?php

namespace App\Conexiones;

use Exception;

class Conexion
{

    public $conexion;

    protected $host;

    protected $usuario;
    protected $contrasena;

    protected $archivoLlavePrivada;

    protected $puerto;

    protected $fraseClave;

    protected $conectado = false;

    /**
     * @throws Exception
     */
    public function __construct(){

        $this->host = config('ssh.host');
        $this->usuario = config('ssh.username');
        $this->contrasena = config('ssh.password');
        $this->archivoLlavePrivada = config('ssh.private_key');
        $this->puerto = config('ssh.port');
        $this->fraseClave = config('ssh.keyphrase');

        $this->validaDatosCofiguracion();

    }

    /**
     * @throws Exception
     */
    private function validaDatosCofiguracion(): void
    {
        if (empty($this->host) || empty($this->usuario)) {
            throw new Exception('No se han configurado los datos de conexión');
        }
    }

    /**
     * @throws Exception
     */
    protected function validaExisteArchivoPk(): void
    {
        if (!file_exists($this->archivoLlavePrivada)) {
            throw new Exception('No se encontró el archivo de llave privada');
        }

    }


}
