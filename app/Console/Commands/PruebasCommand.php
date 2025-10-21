<?php

namespace App\Console\Commands;

use App\Models\Compra;
use App\Models\User;
use App\Notifications\IngresoAlmacen\IngresoAlmacenEnviadoNotificaction;
use Illuminate\Console\Command;

class PruebasCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pruebas';

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
        $user = User::find(1);

        $compra = Compra::find(4);

        $user->notify(new IngresoAlmacenEnviadoNotificaction($compra));
    }
}
