<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CompraReingresarKardexSinCategoria extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:compra-reingresar-kardex-sin-categoria';

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

        $compraDetalles = \App\Models\CompraDetalle::whereHas('kardex', function ($query) {
                $query->whereNull('categoria_id');
            })
            ->get()
        ->sortBy('kardex.created_at');


        $this->line('eliminando detalles de kardex sin categoría');
        foreach ($compraDetalles as $detalle) {

            dump($detalle->kardex->folio);
            $this->line("---Detalle {$detalle->id}- Compra: {$detalle->compra->compra1h->folio} - item {$detalle->item->texto_kardex}");

            if($detalle->item->categoria_id){
                $detalle->kardex()->delete();
            }
        }

//        dd('fin');


        $this->line('reingresando detalles de kardex con categoría');

        foreach ($compraDetalles as $detalle) {

            $this->line("---Detalle {$detalle->id}- Compra: {$detalle->compra->compra1h->folio} - item {$detalle->item->texto_kardex}");

            if($detalle->item->categoria_id){
                $detalle->agregarKardex();
            }
        }

    }
}
