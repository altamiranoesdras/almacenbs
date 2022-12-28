<?php

namespace App\Console\Commands;

use App\Imports\InsumosImport;
use App\Models\Item;
use App\Models\ItemPresentacion;
use App\Models\Renglon;
use App\Models\Unimed;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        DB::table('item_has_categoria')->truncate();
        DB::table('stocks')->truncate();
        DB::table('stocks_transacciones')->truncate();
        DB::table('kardexs')->truncate();
        DB::table('compras')->truncate();
        DB::table('compra_detalles')->truncate();

//        Artisan::call('db:seed', [
//            '--class' => 'RenglonesTableSeeder',
//        ]);
//
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

            Log::error($e->getMessage(),$erros);

        }
        catch (Exception $e){

            Log::error($e->getMessage());


        }


        $this->fin();
        $this->output->success('Importación Exitosa!');

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


    }

}
