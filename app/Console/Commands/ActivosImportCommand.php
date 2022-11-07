<?php

namespace App\Console\Commands;

use App\Imports\ActivosImport;
use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\Renglon;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class ActivosImportCommand extends Command
{

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

        $this->output->title('Iniciando Importación');
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Activo::truncate();
        ActivoEstado::truncate();
        Renglon::truncate();

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


        $this->output->success('Importación Exitosa!');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


    }

}
