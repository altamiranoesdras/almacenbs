<?php

namespace App\Console\Commands;

use App\Models\Kardex;
use Illuminate\Console\Command;

class ObtenerCodigoRequisicionPorCodigoKardex extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kardex:codigo_requisicion';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //solicita codigo de kardex
        $codigoKardex = $this->ask("Ingrese el código de kardex");


        $kardex = \App\Models\Kardex::where('codigo', $codigoKardex)->first();


        if (!$kardex) {
            $this->error("No se encontró el kardex con el código: $codigoKardex");
            return 0;
        }

        $this->imprimeDetalles($kardex, $codigoKardex);


        return 0;
    }

    public function imprimeDetalles(Kardex $kardex, $codigoKardex)
    {
        if($kardex->model instanceof \App\Models\SolicitudDetalle) {

            /**
             * @var \App\Models\Solicitud $solicitud
             */
            $solicitud = $kardex->model->solicitud;
            $this->info("El kardex con código $codigoKardex pertenece a la solicitud: " . $solicitud->codigo);
            //tabla detalles de la solicitud

            $this->table(['id', 'Insumo','Cant Sol','Cant Apro','Cant Desp'], $solicitud->detalles->map(function ($detalle) {
                return [
                    $detalle->id,
                    $detalle->item->text,
                    $detalle->cantidad_solicitada,
                    $detalle->cantidad_aprobada,
                    $detalle->cantidad_despachada
                ];
            }));

        }

        if ($kardex->model instanceof \App\Models\CompraDetalle) {
            $this->info("El kardex con código $codigoKardex pertenece a la compra detalle: " . $kardex->model->compra->codigo);
        }


    }
}
