<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Tienda;
use App\Notifications\Perecederos;
use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class EnviarEmailPerecederos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:perecederos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enviar correo para informar si hay artículos vencidos o próximos a vencer';

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
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->description);

        $tiendas = Bodega::with('administrador')->get();


        foreach ($tiendas as $index => $tienda) {

            $stocksAvencer = Stock::with('item')->quedanMeses(2)->deBodega($tienda->id)->get();


            if ($stocksAvencer->count()>0){

                $userAdmins = $tienda->users()->role(Role::ADMIN)->get();

                if ($userAdmins->count()>0){

                    $mails = $userAdmins->pluck('email')->toArray();

                    $this->info($tienda->nombre.': Enviar mails a '.implode(',',$mails));

                    Notification::send($userAdmins, new Perecederos($stocksAvencer,$tienda));
                }else{
                    $this->info($tienda->nombre.': no hay admins');
                }

            }else{
                $this->info($tienda->nombre.': No hay artículos vencidos o proximos a vencer');
            }
        }
    }
}
