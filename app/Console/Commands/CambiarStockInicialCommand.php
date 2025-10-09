<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\Kardex;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;

class CambiarStockInicialCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cambiar_stock_inicial';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //pregunta por el codigo de insumo
        $codigoInsumo = $this->ask('Ingrese el codigo del insumo:');

        $codigoPresentacion = $this->ask('Ingrese el codigo de presentacion del insumo:');

        //busca el insumo por codigo
        $insumo = \App\Models\Item::where('codigo_insumo', $codigoInsumo)
            ->where('codigo_presentacion', $codigoPresentacion)
            ->first();

        //muestra los stocks actuales
        if ($insumo) {
            $this->table(['Id', 'Codigo Insumo', 'Codigo Presentacion', 'Nombre', 'Stock actual'], [
                [
                    $insumo->id,
                    $insumo->codigo_insumo,
                    $insumo->codigo_presentacion,
                    $insumo->texto_principal,
                    $insumo->stock_total
                ]
            ]);



            $this->dibujarStocks($insumo);
            $this->dibujaKardexs($insumo);

            if ($insumo->estaEnUnaCompra() || $insumo->estaEnUnaSolicitud()) {
                $this->error('El insumo no puede ser modificado porque ya ha sido utilizado en una compra o venta.');
                return;
            }


            $nuevoStock = $this->ask('Ingrese el nuevo stock inicial:');

            $this->procesaActualizacion($insumo, $nuevoStock);

            $insumo->refresh();

            $this->dibujarStocks($insumo);
            $this->dibujaKardexs($insumo);


        } else {
            $this->error('Insumo no encontrado con el codigo proporcionado.');
        }



    }


    public function dibujarStocks(Item $insumo)
    {
        $this->warn("\nStocks");
        $this->table(['Id', 'Unidad solicita', 'Cantidad Stock', 'Fecha Vence', 'Precio'], $insumo->stocks->map(function ($stock) {
            return [
                $stock->id,
                $stock->rrhhUnidad->nombre,
                $stock->cantidad,
                $stock->fecha_vence,
                $stock->precio_compra
            ];
        }));
    }

    public function dibujaKardexs(Item $insumo)
    {
        $this->warn("\nKardexes");
        $this->table(['Id', 'Tipo', 'Cantidad', 'Fecha'], $insumo->kardexes->map(function (Kardex $kardex) {
            return [
                $kardex->id,
                $kardex->tipo,
                $kardex->cantidad,
                $kardex->created_at->format('d/m/y H:i'),
            ];
        }));


    }

    public function procesaActualizacion(Item $insumo, $nuevoStock)
    {
        //si es 0, pregunta si desea eliminar los stocks
        if ($nuevoStock == 0) {
            if ($this->confirm('¿Desea eliminar todos los stocks del insumo?')) {

                $insumo->stocks()->delete();
                $insumo->kardexes()->delete();
                $this->info('Todos los stocks del insumo han sido eliminados.');
            }
        }elseif ($nuevoStock > 0) {

            if ($insumo->stocks->count() > 1) {
                $cantidadDividida = $nuevoStock / $insumo->stocks->count();
                $this->confirm("El stock se dividirá entre los {$insumo->stocks->count()} stocks existentes. ¿Desea continuar?");

                foreach($insumo->stocks as $stock) {
                    $stock->cantidad = $cantidadDividida;
                    $stock->cantidad_inicial = $cantidadDividida;
                    $stock->save();
                }

                $primerKardex = $insumo->kardexes->first();

                //elimina los kardexes existentes
                $insumo->kardexes()->delete();

                $stock->kardex()->create([
                    'item_id' => $stock->item_id,
                    'cantidad' => $nuevoStock,
                    'tipo' => Kardex::TIPO_INGRESO,
                    'codigo' => null,
                    'responsable' => $primerKardex->responsable,
                    'usuario_id' => $primerKardex->usuario_id,
                ]);
            }

            if ($insumo->stocks->count() == 1) {
                $stock = $insumo->stocks->first();
                $stock->cantidad = $nuevoStock;
                $stock->cantidad_inicial = $nuevoStock;
                $stock->save();

                $stock->kardex()->update(['cantidad' => $nuevoStock]);
            }


            $this->info('El stock inicial ha sido actualizado correctamente.');
        }else {
            $this->error('El stock inicial debe ser un número positivo o cero.');
        }

    }
}
