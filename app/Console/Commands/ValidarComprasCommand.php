<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ValidarComprasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'validar_compras';

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
        //validar las compras que tengan transaciones de stock

        foreach (\App\Models\Compra::all() as $compra) {
            if ($compra->tieneTransaccionesStock()) {
                $this->line("Compra {$compra->id} tiene transacciones de stock");
            }
        }
    }
}
