<?php

namespace App\Console\Commands;

use App\Imports\EnviarEnlaceUsuarios;
use App\Models\User;
use App\Notifications\EnviarEnlaceNotificacion;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class EnviarEnlaceUsuariosCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'enviar_enlace';

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

        $usuarios = User::query()
            ->whereNotNull('email')
//            ->whereIn('id',[1,2,3])
            ->get();

        foreach ($usuarios as $usuario) {
            try {
                $usuario->notify(new EnviarEnlaceNotificacion());
            } catch (\Exception $e) {
                $this->error("Error al enviar notificación a {$usuario->name}: {$e->getMessage()}");
                continue;
            }
        }

        $this->fin();

    }
}
