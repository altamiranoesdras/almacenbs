<?php

namespace App\Console\Commands;

use App\Models\Compra;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class ComprasConIngresoDuplicadoComando extends Command
{

    use ComandosTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'compras_con_ingreso_duplicado';

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

        $duplicadas = collect();

        foreach (Compra::all() as $index => $compra) {


            $detallesConDobleTransaccion = $compra->detalles->filter(function ($detalle) {
                return $detalle->transaccionesStock->count() > 1;
            });

            if ($detallesConDobleTransaccion->count() > 0){
                $duplicadas->push($compra);
            }

        }

        $this->info('Se encontraron ' . $duplicadas->count() . ' compras con ingreso duplicado');

        foreach ($duplicadas as $index => $duplicada) {
            $this->line('Compra: ' . $duplicada->id . ' - ' . $duplicada->codigo." Estado: " . $duplicada->estado->nombre);

            foreach ($duplicada->detalles as $index => $detalle) {
                $this->line('  Detalle: ' . $detalle->id . ' - ' . $detalle->item->nombre . ' - ' . $detalle->cantidad . ' - ' . $detalle->precio);

//                foreach ($detalle->transaccionesStock as $index => $transaccion) {
//                    $this->line('----   Transaccion: ' . $transaccion->id . ' - ' . $transaccion->cantidad . ' - ' . $transaccion->precio);
//                }
            }

            $this->line('-------------------------------------------------------------------');
        }
    }
}
