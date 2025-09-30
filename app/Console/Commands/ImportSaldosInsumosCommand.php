<?php

namespace App\Console\Commands;

use App\Imports\ImportSaldosInsumos;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Validators\ValidationException;

class ImportSaldosInsumosCommand extends Command
{

    use ComandosTrait;



    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:saldos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importar stock inicial insumos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $this->inicio();

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('stocks')->truncate();
//        DB::table('items')->update(['precio_compra' => 0]);

        try {


            $import = new ImportSaldosInsumos();

            $import->withOutput($this->output)->import(storage_path('imports/saldos_insumos.xlsx'));

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

        $this->fin($import->errores);


        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
