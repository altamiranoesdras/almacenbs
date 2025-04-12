<?php


namespace App\Traits;


use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

trait ComandosTrait
{
    private $barraProceso;

    public function inicio()
    {
        $this->tiempoIni = microtime(true);

        $this->info("inicio ...");
    }

    /**
     * Devuelve el texto "Tiempo empleado: ". $minutes.' min '. $seconds." Segundos"
     * @return string
     */
    public function fin(Collection $errores= null)
    {

        $tiempoFin = microtime(true);
        $duration = $tiempoFin - $this->tiempoIni;
        $hours = (int)($duration/60/60);
        $minutes = (int)($duration/60)-$hours*60;
        $seconds = (int)$duration-$hours*60*60-$minutes*60;




        if (isset($errores) && $errores->count() > 0){

            $this->output->error("Errores");
            $this->table(['Error'], $errores->toArray());

        }else{

            $this->output->success('Comando ejecutado correctamente');

            $this->info("\n### Fin ####");
            $tiempoEmpleadoText = "Tiempo empleado: ". $minutes.' min '. $seconds." Segundos";
            $this->info($tiempoEmpleadoText);


        }

        return $tiempoEmpleadoText;
    }

    public function guardarLog($contenido='contenido')
    {

        $nombreClase = str_replace('App\\Console\\Commands\\','',get_class($this));

        if (!file_exists(storage_path('logs/comandos/'))){
            mkdir(storage_path('logs/comandos/'));
        }

        $file =storage_path('logs/comandos/'.'Log'.$nombreClase.'.txt');


        File::put($file,$contenido);

    }

    public function barraProcesoIniciar($cantidadRegistros)
    {

        $this->barraProceso = $this->output->createProgressBar($cantidadRegistros);
        $this->barraProceso->start();
    }

    public function barraProcesoAvanzar()
    {
        $this->barraProceso->advance();
    }

    public function barraProcesoFin()
    {
        $this->barraProceso->finish();
    }
}
