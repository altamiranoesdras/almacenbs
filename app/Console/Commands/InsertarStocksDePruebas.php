<?php

namespace App\Console\Commands;

use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsertarStocksDePruebas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stocks_de_pruebas';

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
        //iterar todos los items de la tabla items
        foreach (Item::all() as $item) {

            $fechaRandom = Carbon::now()->addMonths(rand(-6, 6));

            //crear stock para cada item
            $item->actualizaOregistraStcokInicial(100,$fechaRandom);
        }
    }
}
