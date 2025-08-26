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

class ReingresarDetalleCompra extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compras:reingresar-detalle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cuando se registro una compra con un insumo que tenía campo inventariable en 0,
    se cambia a inventariable y se necesita reingresar el detalle de la compra para que genere la transacción de stock';

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

        $compra = Compra::where('codigo',$codigo)->first();

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

        /**
         * @var CompraDetalle $detalleAreingresar
         */
        $detalleAreingresar = $compra->detalles->where('id',$idDetalle)->first();



        $confirmar = $this->ask("Confirma el reingreso de {$detalleAreingresar->cantidad} - {$detalleAreingresar->item->text} (s/n)?");

        if ($confirmar == 's' || $confirmar == 'S') {
            $this->reingresarDetalle($detalleAreingresar);
        }

        $this->line("Detalle después de reingresar");

        $this->dibujaDetalles($compra,$idDetalle);


        return 0;
    }


    public function reingresarDetalle(CompraDetalle $detalleAreingresar)
    {


        try {
            DB::beginTransaction();


            //actualiza el insumo invetariable=1
            $insumo = $detalleAreingresar->item;
            $insumo->inventariable=1;
            $insumo->save();

            $detalleAreingresar->refresh();



            $detalleAreingresar->ingreso();
//            $detalleAreingresar->agregarKardex();
            $detalleAreingresar->refresh();

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
                $detalle->item->stock_total,
            ];
        });

        $this->table(['Id', 'insumo','Cantidad','Stock'], $detalles->toArray() );

        if ($idDetalle){
            $detalle = $compra->detalles->where('id',$idDetalle)->first();

            if($detalle->transaccionesStock->count() == 0){
                $this->error("El detalle no tiene transacciones de stock");
                return;
            }
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

