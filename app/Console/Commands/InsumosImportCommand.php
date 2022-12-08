<?php

namespace App\Console\Commands;

use App\Imports\ActivosImport;
use App\Imports\InsumosImport;
use App\Models\Activo;
use App\Models\ActivoEstado;
use App\Models\ActivoTipo;
use App\Models\Item;
use App\Models\ItemPresentacion;
use App\Models\Renglon;
use App\Models\Unimed;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Validators\ValidationException;

class InsumosImportCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:insumos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importar insumos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::connection()->disableQueryLog();
        $this->inicio();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Item::truncate();
        Unimed::truncate();
        ItemPresentacion::truncate();
        Renglon::truncate();

//        Artisan::call('db:seed', [
//            '--class' => 'ActivoEstadosTableSeeder',
//        ]);
//
//        Artisan::call('db:seed', [
//            '--class' => 'RenglonesTableSeeder',
//        ]);
//
//        Artisan::call('db:seed', [
//            '--class' => 'ActivoTiposTableSeeder',
//        ]);

        $this->output->info('Tablas truncadas y seeder ejecutados');

        try {

            $import = new InsumosImport();

            $import->withOutput($this->output)->import(storage_path('imports/CATALOGO DE INSUMOS.xlsx'));

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
