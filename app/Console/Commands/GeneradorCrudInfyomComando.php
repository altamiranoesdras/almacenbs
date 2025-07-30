<?php

namespace App\Console\Commands;

use App\Traits\ComandosTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class GeneradorCrudInfyomComando extends Command
{
    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private string $genero;
    private string $nombreTablaLenguajeNatural;

    private string $nombreModelo;

    private string|null $tabla;

    private string $creaApi;

    private string $creaMigracion;

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->inicio("Generando CRUD extendido con Infyom");

        //solicitar nombre de la tabla
        $this->tabla = $this->ask("Ingrese el nombre de la tabla");

        //si la tabla no existe
        if(!Schema::hasTable($this->tabla) || is_null($this->tabla)){
            $this->error('La tabla no existe');
            return 0;
        }

        $this->creaMigracion = $this->askWithCompletion('¿Desea crear la migración para la tabla? (si/no)', ['si', 'no'], 'no');
        $this->creaApi = $this->askWithCompletion('¿Desea crear la API para la tabla? (si/no)', ['si', 'no'], 'si');
        $this->genero = $this->askWithCompletion("Seleccione el género de la tabla (m/f)", ['m', 'f'], 'm');
        $this->nombreModelo = Str::ucfirst(Str::camel(Str::singular($this->tabla)));


        $this->generaCrud();

        $this->generMiracion();

        $this->editarFactory();

        $this->cambiaPalabrasSinGenero();

        $nombreTablaLenguajeNatural = Str::title(Str::snake($this->tabla, ' '));



        $this->fin();

        return 0;
    }


    public function generaCrud(): void
    {
        $comando = $this->creaApi=='si' ? 'infyom:api_scaffold' : 'infyom:scaffold';

        $this->call($comando, [
            'model' => $this->nombreModelo,
            '--fromTable' => true,
            '--table' => $this->tabla,
            '--skip' => 'menu',
        ]);

    }


    public function generMiracion(): void
    {
        if($this->creaMigracion=='si'){
            Artisan::call('migrate:generate',[
                '--tables' => $this->tabla,
                '--no-interaction' => true,
            ]);

            $this->info('Migración creada exitosamente');
        }

    }


    public function cambiaPalabrasSinGenero(): void
    {

        $carpetaVistas = resource_path('views/'.$this->tabla);

        foreach (File::files($carpetaVistas) as $archivo) {
            $nombreArchivo = $archivo->getFilename();

            if ($nombreArchivo == 'index.blade.php') {
                $this->line('Cambiando palabras sin género del archivo '.$nombreArchivo);
                $contenido = File::get($archivo);
                $contenido = str_replace('Nuev@',$this->genero=='masculino' ? 'Nuevo' : 'Nueva', $contenido);
                $archivo->openFile('w')->fwrite($contenido);
            }

        }
    }

    public function editarFactory(): void
    {

        $this->line('Editando el archivo factory');

        //ruta del archivo factory
        $archivoFactory = database_path('factories/'.$this->nombreModelo.'Factory.php');
        $contenido = File::get($archivoFactory);

        //reemplazar el valor de deleted_at y lo cambia por null para que no cree registros eliminados
        $contenido = str_replace("'deleted_at' => \$this->faker->date('Y-m-d H:i:s')", "'deleted_at' => null", $contenido);
        File::put($archivoFactory, $contenido);

        $this->info('Factory editado exitosamente');
    }



}
