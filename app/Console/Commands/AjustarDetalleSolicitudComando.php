<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Kardex;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\Stock;
use App\Models\StockTransaccion;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class AjustarDetalleSolicitudComando extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ajuste_detalle_solicitud';

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
        $this->inicio();

        $codigo = $this->ask("Ingrese el id de la solicitud");

        $solicitud = Solicitud::where('codigo', $codigo)->first();

        if ($solicitud) {
            $this->info("Solicitud encontrada: " . $solicitud->id);

            $this->table(['id', 'item', 'cantidad_solicitada', 'cantidad_aprobada', 'cantidad_despachada'], $solicitud->detalles->map(function ($detalle) {
                return [
                    'id' => $detalle->id,
                    'item' => $detalle->item->nombre,
                    'cantidad_solicitada' => $detalle->cantidad_solicitada,
                    'cantidad_aprobada' => $detalle->cantidad_aprobada,
                    'cantidad_desembolsada' => $detalle->cantidad_despachada,
                ];
            }));

            //solicitar id del detalle a ajustar
            $detalle_id = $this->ask("Ingrese el id del detalle a ajustar:");
            $detalle = $solicitud->detalles->find($detalle_id);

            if ($detalle) {

                $this->muestraDatosDetalle($detalle);


                $cantidadDespachada = $detalle->cantidad_despachada;
                //solicitar cantidad a ajustar
                $cantidadAjuste = $this->ask("Ingrese la cantidad a ajustar:");
                $diferencia = $cantidadAjuste - $cantidadDespachada;

                $detalle->cantidad_solicitada = $cantidadAjuste;
                $detalle->cantidad_aprobada = $cantidadAjuste;
                $detalle->cantidad_despachada = $cantidadAjuste;
                $detalle->save();

                $transaccion = $detalle->transaccionesStock->first();
                $stock = $transaccion->stock;
                $kardex = $detalle->kardexs->first();

                $transaccion->cantidad = $cantidadAjuste;
                $transaccion->save();

                $stock->cantidad = $stock->cantidad + $diferencia;
                $stock->save();

                $kardex->can = $cantidadAjuste;

                $this->info("Detalle ajustado correctamente");

                $this->muestraDatosDetalle($detalle);


            } else {
                $this->error("Detalle no encontrado");
            }
        }else{
            $this->error("Solicitud no encontrada");
        }

    }

    public function muestraDatosDetalle(SolicitudDetalle $detalle)
    {

        $detalle->refresh();
        $this->info("Detalle : " );
        $this->table(['id', 'item', 'cantidad_solicitada', 'cantidad_aprobada', 'cantidad_despachada'], [
            [
                'id' => $detalle->id,
                'item' => $detalle->item->nombre,
                'cantidad_solicitada' => $detalle->cantidad_solicitada,
                'cantidad_aprobada' => $detalle->cantidad_aprobada,
                'cantidad_desembolsada' => $detalle->cantidad_despachada,
            ]
        ]);

        $this->info("Transacciones: " );
        $this->table(['stock_id','tipo','cantidad','precio_costo'], $detalle->transaccionesStock->map(function (StockTransaccion $transaccion) {
            return [
                'stock_id' => $transaccion->stock_id,
                'tipo' => $transaccion->tipo,
                'cantidad' => $transaccion->cantidad,
                'precio_costo' => $transaccion->precio_costo,
            ];
        }));

        $this->info("Stoks");
        $stocks =$detalle->item->stocks()->where('bodega_id',Bodega::PRINCIPAL)->get();
        $this->table(['id', 'bodega_id','precio_compra','cantidad','cantidad_inicial'], $stocks->map(function (Stock $stock) {
            return [
                'id' => $stock->id,
                'bodega_id' => $stock->bodega_id,
                'precio_compra' => $stock->precio_compra,
                'cantidad' => $stock->cantidad,
                'cantidad_inicial' => $stock->cantidad_inicial,
            ];
        }));

        $this->info("Kardex:");

        $this->table(['id','cantidad','precio_movimiento','precio_existencia','tipo'], $detalle->kardexs->map(function (Kardex $kardex) {
            return [
                'id' => $kardex->id,
                'cantidad' => $kardex->cantidad,
                'precio_movimiento' => $kardex->precio_movimiento,
                'precio_existencia' => $kardex->precio_existencia,
                'tipo' => $kardex->tipo,
            ];
        }));

    }
}
