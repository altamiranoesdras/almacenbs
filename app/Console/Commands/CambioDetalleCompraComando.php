<?php

namespace App\Console\Commands;

use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\SolicitudDetalle;
use App\Models\StockTransaccion;
use App\Traits\ComandosTrait;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CambioDetalleCompraComando extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compras:cambio-detalle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambia un detalle de una de compra';

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
     * @throws Exception
     */
    public function handle()
    {

        $codigo = $this->ask("Ingrese el código de la compra");

        $compra = \App\Models\Compra::where('codigo',$codigo)->first();

        if (!$compra) {
            $this->error("No se encontró la compra con el código: $codigo");
            return 0;
        }

        $this->info("Compra encontrada: $compra->codigo");

        //detalles de la compra
        $this->dibujaDetalles($compra,null);

        //solicitar id detalle a cambiar
        $idDetalle = $this->ask("Ingrese el id del detalle a cambiar");


        $this->dibujaDetalles($compra,$idDetalle);

        $detalleCambiar = $compra->detalles->where('id',$idDetalle)->first();


        $idNuevoInsumo = $this->ask("Ingrese el id del nuevo insumo");
        $nuevaCantidad = $this->ask("Ingrese la nueva cantidad");
        $nuevoInsumo = \App\Models\Item::find($idNuevoInsumo);


        $this->table(["Insumo Origen","Cantidad","Insumo Nuevo","Nueva Cantidad"],[[
            $detalleCambiar->item->text,
            $detalleCambiar->cantidad,
            $nuevoInsumo->text,
            $nuevaCantidad
        ]]);

        $confirmar = $this->ask("Confirma el cambio? (s/n)");

        if ($confirmar == 's' || $confirmar == 'S') {
            $this->cambioDetalles($detalleCambiar,$nuevoInsumo,$nuevaCantidad);
        }

        $this->line("Detalle cambiado");

        $this->dibujaDetalles($compra,$idDetalle);


        return 0;
    }


    public function cambioDetalles(CompraDetalle $detalleCambiar,$nuevoInsumo,$nuevaCantidad)
    {


        try {
            DB::beginTransaction();

            $diferencia = abs($detalleCambiar->cantidad - $nuevaCantidad);
            $kardexAntes = $detalleCambiar->kardex;


            //elimina kardex y revierte transacciones
            $detalleCambiar->anular();
            //elimina transacciones de stock
            $detalleCambiar->transaccionesStock->last()->delete();


            $detalleCambiar->cantidad = $nuevaCantidad;
            $detalleCambiar->item_id = $nuevoInsumo->id;
            $detalleCambiar->save();
            $detalleCambiar->refresh();


            $detalleCambiar->ingreso();
            $detalleCambiar->agregarKardex();
            $detalleCambiar->refresh();



            //el Kardex que se crea en el ingreso se crea con la fecha actual, se debe cambiar a la fecha del kardex anterior
            $kardexDespues = $detalleCambiar->kardex;

            $kardexDespues->created_at = $kardexAntes->created_at;
            $kardexDespues->updated_at = $kardexAntes->updated_at;
            $kardexDespues->save();

        } catch (Exception $exception) {
            DB::rollBack();

            throw new Exception($exception);
        }

        DB::commit();

    }


    public function dibujaDetalles(Compra $compra,$idDetalle)
    {

        $detalles = $compra->detalles->filter(function (CompraDetalle $detalle) use ($idDetalle) {
            if ($idDetalle){
                return $detalle->id == $idDetalle;
            }
            return $detalle;
        });

        $detalles = $detalles->map(function (CompraDetalle $detalle) {

            return [
                $detalle->id,
                $detalle->item->text,
                $detalle->cantidad,
            ];
        });

        $this->table(['Id', 'insumo','Cantidad'], $detalles->toArray() );

        if ($idDetalle){
            $detalle = $compra->detalles->where('id',$idDetalle)->first();

            //transacciones de stock
            $this->table(['Id', 'Cantidad', 'Precio', 'Tipo', 'Bodega'], $detalle->transaccionesStock->map(function (StockTransaccion $transaccion) {
                return [
                    $transaccion->id,
                    $transaccion->cantidad,
                    $transaccion->precio_costo,
                    $transaccion->tipo,
                    $transaccion->stock->bodega->nombre,
                ];
            }));
        }


    }

}
