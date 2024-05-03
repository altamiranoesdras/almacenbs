<?php

namespace App\Console\Commands;

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



        $this->info('Buscando compras con ingreso duplicado');

        $id = $this->option('id');
        $duplicadas = $this->comprasConIngresoDuplicado($id);

        $this->info('Se encontraron ' . $duplicadas->count() . ' compras con ingreso duplicado');

        /**
         * @var Compra $duplicada
         */
        foreach ($duplicadas as $index => $duplicada) {
            $this->line('');
            $this->warn('Compra: ' . $duplicada->id . ' - ' . $duplicada->codigo." Estado: " . $duplicada->estado->nombre);

            $this->dibujarTablaDetalles($duplicada);

//            $this->dibujarTablaTransaciones($duplicada);

//            $this->dibujarTablaStocks($duplicada);

//            $this->realizarAjuste($duplicada);


        }

        $this->fin();


    }

    function comprasConIngresoDuplicado($id=null){

        $duplicadas = collect();

        if ($id){
            $compras = Compra::where('id', $id)->get();
        } else {
            $compras = Compra::all();
        }

        foreach ($compras as $index => $compra) {


            $detallesConDobleTransaccion = $compra->detalles->filter(function ($detalle) {
                return $detalle->transaccionesStock->count() > 1;
            });

            if ($detallesConDobleTransaccion->count() > 0){
                $duplicadas->push($compra);
            }

        }

        return $duplicadas;
    }

    function realizarAjuste(Compra $compra){
        $this->line("Realizando ajustes");

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
            return $detalle->transaccionesStock->map(function ($transaccion) {
                return [
                    'id' => $transaccion->stock->id,
                    'cantidad' => $transaccion->stock->cantidad,
                    'precio_compra' => $transaccion->stock->precio_compra,
                    'fecha_vence' => $transaccion->stock->fecha_vence,
                ];
            });
        })->flatten(1));
    }
}
