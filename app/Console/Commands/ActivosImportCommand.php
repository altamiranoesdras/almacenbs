<?php

namespace App\Console\Commands;

use App\Imports\ActivosImport;
use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Renglon;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class ActivosImportCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:activos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importar activos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::connection()->disableQueryLog();
        $this->inicio();

        $this->output->title('Iniciando Importación');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Activo::truncate();
        ActivoTipo::truncate();
        ActivoEstado::truncate();
        Renglon::truncate();

        Artisan::call('db:seed', [
            '--class' => 'ActivoEstadosTableSeeder',
        ]);

        Artisan::call('db:seed', [
            '--class' => 'RenglonesTableSeeder',
        ]);

        Artisan::call('db:seed', [
            '--class' => 'ActivoTiposTableSeeder',
        ]);

        try {

            $import = new ActivosImport();

            $import->withOutput($this->output)->import(public_path('imports/activos/plantilla_import_activos.xlsx'));

        }
        catch (ValidationException $e) {

            DB::rollBack();
            $erros = array();
            foreach ($e->failures() as $failure) {
                $erros[] = "Error en fila ".$failure->row().": ".implode($failure->errors());
            }

            \Log::debug($erros);

        }
        catch (Exception $e){

            \Log::debug($e);

            throw $e;

        }


        $this->fin();
        $this->output->success('Importación Exitosa!');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


    }

}
