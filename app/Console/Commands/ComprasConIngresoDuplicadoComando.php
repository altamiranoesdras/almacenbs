<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Compra;
use App\Models\StockTransaccion;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class ComprasConIngresoDuplicadoComando extends Command
{

    use ComandosTrait;

    /**
     * nombre del comando en consola con argumento opcional para filtrar por compra
     * @var string $signature
     */
    protected $signature = 'compras_con_ingreso_duplicado {--id=}';

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

        $id = $this->option('id');

        $duplicadas = $this->comprasConIngresoDuplicado($id);


        /**
         * @var Compra $duplicada
         */
        foreach ($duplicadas as $index => $duplicada) {
            $this->line('');
            $this->warn('Compra: ' . $duplicada->id . ' - ' . $duplicada->codigo." Proveedor: " . $duplicada->proveedor->nombre);

            $this->dibujarDetalles($duplicada);

            $res = $this->ask("Confirma realizar ajuste? (s/n) ");

            if ($res == 's' || $res == 'S'){
                $this->realizarAjuste($duplicada);
                $this->dibujarDetalles($duplicada);
            }

        }

        $this->fin();


    }

    function comprasConIngresoDuplicado($id=null){

        $duplicadas = collect();

        if ($id){
            $compra = Compra::find($id);
            $duplicadas->push($compra);

        } else {
            $this->info('Buscando compras con ingreso duplicado');

            $duplicadas = Compra::all()->filter(function ($compra) {
                return $compra->tieneDobleIngreso();
            });

            $this->info('Se encontraron ' . $duplicadas->count() . ' compras con ingreso duplicado');

        }

        return $duplicadas;
    }

    function realizarAjuste(Compra $compra)
    {

        $this->line('');

        $ajustesEnOtrosStoks = collect();


        if ($compra->tieneDobleIngreso()){

            $this->warn("Realizando ajustes ...");


            //elimina transacciones duplicadas
            $compra->detalles->each(function ($detalle) use ($ajustesEnOtrosStoks) {
                //si tiene mas de una transaccion el detalle
                if ($detalle->transaccionesStock->count() > 1){
                    /**
                     * @var \App\Models\StockTransaccion $ultimaTransaccion
                     */
                    $ultimaTransaccion = $detalle->transaccionesStock->last();
                    $stock = $ultimaTransaccion->stock;

                    if ($stock->cantidad > 0){
                        $stock->cantidad -= $ultimaTransaccion->cantidad;
                        $stock->save();
                    }else{
                        $otrosStoks = $detalle->item->stocks->filter(function ($stock) {
                            return $stock->cantidad > 0 && $stock->bodega_id == Bodega::PRINCIPAL;
                        });

                        if ($otrosStoks->count() > 0){
                            $stock = $otrosStoks->first();
                            $stock->cantidad -= $ultimaTransaccion->cantidad;
                            $stock->save();
                            $ajustesEnOtrosStoks->push($stock);
                        }
                    }

                    $ultimaTransaccion->delete();
                }
            });
        }else{
            $this->warn("No se puede realizar ajuste, la compra no tiene ingreso duplicado");
        }

        if ($ajustesEnOtrosStoks->count() > 0){
            $this->warn('Se realizaron ajustes en stock diferentes a las transacciones');
            $this->table(['id', 'cantidad', 'precio_compra', 'fecha_vence'], $ajustesEnOtrosStoks->map(function ($stock) {
                return [
                    'id' => $stock->id,
                    'cantidad' => $stock->cantidad,
                    'precio_compra' => $stock->precio_compra,
                    'fecha_vence' => $stock->fecha_vence,
                ];
            }));
        }

    }


    public function dibujarDetalles(Compra $compra)
    {

        $compra->refresh();

        $this->dibujarTablaDetalles($compra);

        $this->dibujarTablaTransaciones($compra);

        $this->dibujarTablaStocks($compra);

    }
    function dibujarTablaDetalles(Compra $compra){
        $this->line('Detalles');

        $this->table(['id','codigo_insumo','nombre_insumo','cantidad','precio'], $compra->detalles->map(function ($detalle) {
            return [
                'id' => $detalle->id,
                'codigo_insumo' => $detalle->item->codigo_insumo,
                'nombre_insumo' => $detalle->item->nombre,
                'cantidad' => $detalle->cantidad,
                'precio' => $detalle->precio,
            ];
        }));
    }

    function dibujarTablaTransaciones(Compra $compra){
        $this->line('Transacciones:');

        $this->table(['id','fecha','cantidad','precio','tipo','stock_id'], $compra->detalles->map(function ($detalle) {
            return $detalle->transaccionesStock->map(function ($transaccion) {
                return [
                    'id' => $transaccion->id,
                    'fecha' => $transaccion->created_at,
                    'cantidad' => $transaccion->cantidad,
                    'precio' => $transaccion->precio_costo,
                    'tipo' => $transaccion->tipo,
                    'stock_id' => $transaccion->stock_id,
                ];
            });
        })->flatten(1));
    }

    function dibujarTablaStocks(Compra $compra){
        $this->line('Stoks:');

        $stocks = $this->obtenerStocksItemsDetalles($compra->detalles);

        $this->table(['id','cantidad','precio_compra','fecha_vence'], $stocks->map(function ($stock) {
            return [
                'id' => $stock->id,
                'cantidad' => $stock->cantidad,
                'precio_compra' => $stock->precio_compra,
                'fecha_vence' => $stock->fecha_vence,
            ];
        }));
    }

    public function obtenerStocksItemsDetalles($detalles): \Illuminate\Support\Collection
    {
        $stoks = collect();

        $detalles->each(function ($detalle) use ($stoks) {
            $detalle->item->stocks->each(function ($stock) use ($stoks) {
                if ($stock->bodega_id == Bodega::PRINCIPAL){
                    $stoks->push($stock);
                }
            });
        });

        return $stoks;

    }
}
