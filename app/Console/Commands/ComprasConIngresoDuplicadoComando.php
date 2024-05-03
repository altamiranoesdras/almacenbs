<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Compra;
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

            $this->dibujarTablaDetalles($duplicada);

            $this->dibujarTablaTransaciones($duplicada);

            $this->dibujarTablaStocks($duplicada);

            $this->realizarAjuste($duplicada);

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

    function realizarAjuste(Compra $compra){

        $this->line('');

        if ($compra->tieneDobleIngreso()){

            $this->warn("Realizando ajustes ...");

            //elimina transacciones duplicadas
            $compra->detalles->each(function ($detalle) {
                //si tiene mas de una transaccion el detalle
                if ($detalle->transaccionesStock->count() > 1){
                    /**
                     * @var \App\Models\StockTransaccion $ultimaTransaccion
                     */
                    $ultimaTransaccion = $detalle->transaccionesStock->last();
                    $stock = $ultimaTransaccion->stock;

                    if ($stock->cantidad >= $ultimaTransaccion->cantidad){
                        $stock->cantidad -= $ultimaTransaccion->cantidad;
                        $stock->save();
                    }

                    $ultimaTransaccion->delete();
                }
            });
        }else{
            $this->warn("No se puede realizar ajuste, la compra no tiene ingreso duplicado");
        }

    }

    function dibujarTablaDetalles(Compra $compra){
        $this->line('');

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
        $this->line('');

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
        $this->line('');

        $this->table(['id','cantidad','precio_compra','fecha_vence'], $compra->detalles->map(function ($detalle) {
            return $detalle->item->stocks->map(function ($stock) {

                if ($stock->bodega_id == Bodega::PRINCIPAL){
                    return [
                        'id' => $stock->id,
                        'cantidad' => $stock->cantidad,
                        'precio_compra' => $stock->precio_compra,
                        'fecha_vence' => $stock->fecha_vence,
                    ];
                }
            });
        })->flatten(1));
    }
}
