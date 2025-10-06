<?php

namespace App\Console\Commands;

use App\Imports\ImportSaldosInsumos;
use App\Models\Kardex;
use App\Models\Stock;
use App\Models\StockTransaccion;
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

        StockTransaccion::truncate();
        Stock::truncate();
        Kardex::truncate();

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

        $this->fin();

        $this->line("Errores encontrados: ".$import->errores->count());
        foreach ($import->errores as $error){
            $this->line($error);
        }

        $this->line("Insumos procesados: ".$import->acutalizados+$import->nuevos);
        $this->line("Insumos actualizados: ".$import->acutalizados);
        $this->line("Insumos nuevos: ".$import->nuevos);

        $this->actualizaResponsableKardex();

        DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }

    public function actualizaResponsableKardex()
    {
        $this->line("Actualizando responsable de kardex...");



        foreach (Kardex::all() as $kardex) {

            if($kardex->model instanceof Stock){
                $kardex->responsable = "Existencia inicial segun acta Administrativa 006-2025, de fecha 30 de septiembre";
                $kardex->save();
            }
        }

        $this->line("Responsables actualizados: ".$kardex->count());

    }
}
