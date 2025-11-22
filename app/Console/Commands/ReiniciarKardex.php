<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Compra;
use App\Models\Kardex;
use App\Models\Solicitud;
use App\Models\Stock;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class ReiniciarKardex extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reiniciar-kardex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $this->inicio();

        $this->line("Truncando tablas de Kardexs");

        Kardex::truncate();

        $this->procesarStocksIniciales();

//        $this->procesarIngresosYegresos();

        $this->fin();
    }

    public function procesarStocksIniciales()
    {
        $stocksIniciales = Stock::query()
            ->where('bodega_id', Bodega::PRINCIPAL)
            ->whereDate('fecha_ing', "2025-10-06")
//            ->where('id','<=', 384)
//            ->whereHas('item', function ($query) {
//                $query->where('id',  438);
//            })
            ->get();


        $this->line("Reingresando " . $stocksIniciales->count() . " stocks iniciales");

        $this->barraProcesoIniciar($stocksIniciales->count());

        foreach ($stocksIniciales as $stock) {
            $this->barraProcesoAvanzar();
            $stock->agregaKardex('Existencia inicial según acta Administrativa 007-2025, de fecha 30 de septiembre','2025-07-30');
        }

        $this->barraProcesoFin();

    }

    /**
     * @throws \Exception
     */
    public function procesarIngresosYegresos()
    {

        $ingresos = Compra::autorizadas()
//                ->whereHas('detalles.item', function ($query) {
//                    $query->where('id',  438);
//                })
            ->get();
        $egresos  = Solicitud::despachadas()
//            ->whereHas('detalles.item', function ($query) {
//                $query->where('id',  438);
//            })
            ->get();

        $this->line("\n\nReingresando movimientos: " . $ingresos->count() . " ingresos y " . $egresos->count() . " egresos");


        $ingresoEgresos = $ingresos
            ->concat($egresos)          // une sin sobrescribir
            ->sortBy('fecha_ordena_kardex')  // ordena
            ->values();                 // reindexa 0,1,2,...

        $this->barraProcesoIniciar($ingresoEgresos->count());

        foreach ($ingresoEgresos as $movimiento) {

            $this->barraProcesoAvanzar();

            if ($movimiento instanceof Compra) {
                $movimiento->procesarKardex(false);
            } elseif ($movimiento instanceof Solicitud) {

                foreach ($movimiento->detalles as $detalle) {
                    $detalle->agregarKardex();
                }

            } else {
                $this->warn("Tipo de movimiento desconocido: " . get_class($movimiento));
            }

        }

        $this->barraProcesoFin();

    }
}
