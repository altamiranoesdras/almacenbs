<?php

namespace App\Conexiones;

use Exception;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SSH2;

class SSH extends Conexion
{


    public function __construct($autoConectar = true)
    {
        parent::__construct();
        if ($autoConectar) {
            $this->conectarConContrasena();
        }
    }


    /**
     * @throws Exception
     */
    public function conectarConLlavePrivada(): void
    {
        $this->validaExisteArchivoPk();
        $this->conexion = new SSH2($this->host, $this->puerto);
        $key = PublicKeyLoader::load(file_get_contents($this->archivoLlavePrivada), $this->fraseClave);
        if (!$this->conexion->login($this->usuario, $key)) {
            throw new Exception('No se pudo conectar con la llave privada');
        }
        $this->conectado = true;
    }



    /**
     * @throws Exception
     */
    public function conectarConContrasena(): void
    {
        $this->conexion = new SSH2($this->host, $this->puerto);
        if (!$this->conexion->login($this->usuario, $this->contrasena)) {
            throw new Exception('No se pudo conectar con la contraseña');
        }
        $this->conectado = true;
    }

    public function desconectar(): void
    {
        if ($this->conexion) {
            $this->conexion->disconnect();
        }
        $this->conectado = false;
    }

    public function ejecutar($command)
    {
        return $this->conexion->exec($command);
    }


}
