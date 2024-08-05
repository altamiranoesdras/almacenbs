<?php

namespace App\Conexiones;

use Exception;
use phpseclib3\Crypt\PublicKeyLoader;
use phpseclib3\Net\SFTP as SftpBase;

class SFTP extends Conexion
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
        $this->conexion = new SftpBase($this->host);
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

        $this->conexion = new SftpBase($this->host, $this->puerto);
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

    /**
     * @throws Exception
     */
    public function descargar($archivoRemoto, $archivoLocal)
    {
        if (!$this->conectado) {
            throw new Exception('No se ha establecido la conexión');
        }

        return $this->conexion->get($archivoRemoto, $archivoLocal);
    }

}
