<?php

namespace App\Console\Commands;

use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class VaciarStockBodega extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vaciar_stock_bodega {bodega_id?}';

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

        $bodegaId = $this->argument('bodega_id');

        if (!$bodegaId){
            $this->error('Debe especificar el id de la bodega');

            $todasLasBodegas = \App\Models\Bodega::all();

            $this->info('Las bodegas disponibles son:');

            foreach ($todasLasBodegas as $bodega){
                $this->info($bodega->id . ' - ' . $bodega->nombre);
            }

            return 1;
        }

        $bodega = \App\Models\Bodega::find($bodegaId);

        if (!$bodega){
            $this->error('No se encontró la bodega con id: ' . $bodegaId);
            return 1;
        }

        $this->info('Se vaciará el stock de la bodega: ' . $bodega->nombre);


        $stocks = \App\Models\Stock::whereBodegaId($bodegaId)->delete();

        $this->info('Vaciar stock de bodega exitoso!');

    }
}
