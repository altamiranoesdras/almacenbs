<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Kardex;
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
     */
    public function handle()
    {
        $this->inicio();

        $stocksIniciales = Stock::query()
            ->where('bodega_id', Bodega::PRINCIPAL)
            ->where('id','<=', 384)
            ->get();

        Kardex::truncate();

        foreach ($stocksIniciales as $stock) {
            $stock->kardex()->create([
                'categoria_id' => $stock->item->categoria_id,
                'item_id' => $stock->item_id,
                'cantidad' => $stock->cantidad_inicial,
                'precio_existencia' => $stock->precio_compra,
                'precio_movimiento' => $stock->precio_compra,
                'tipo' => Kardex::TIPO_INGRESO,
                'codigo' => '',
                'responsable' => 'Existencia inicial según acta Administrativa 007-2025, de fecha 30 de septiembre',
                'usuario_id' => 1, // Usuario principal
                'folio_siguiente' => '',
            ]);
        }

    }
}
