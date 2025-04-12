<?php

namespace App\Console\Commands;

use App\Models\Kardex;
use Illuminate\Console\Command;

class ValidarFoliosRepetidosKardexComando extends Command
{

    use \App\Traits\ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folios_repetidos_kardex';

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
        $this->inicio("Inicio script...");
        $kardexs = \App\Models\Kardex::all();

        //contar los folios por item
        $folios = $kardexs->groupBy('folio')->map(function ( $kardex){
            return $kardex->groupBy('item_id')->count();
        });


        $repetidos = $folios->filter(function ($cantidad,$folio){


            if ($cantidad > 1){
                return $folio;
            }
        })->keys();

        $kardexsRepetidos = $kardexs->whereIn('folio',$repetidos)->groupBy('item_id')->map(function ($kardex){
            return $kardex->first();
        })->sortBy('folio');

        $this->table(['Folio','Item','codigo insumo','codigo presentacion'], $kardexsRepetidos->map(function ($kardex){
            return [
                'folio' => $kardex->folio,
                'item' => $kardex->item->nombre,
                'codigo_insumo' => $kardex->item->codigo_insumo,
                'codigo_presentacion' => $kardex->item->codigo_presentacion,
            ];
        }));

        $this->fin();
    }
}
