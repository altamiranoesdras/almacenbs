<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Notifications\NoticiaPrueba;

class NoticiaPruebaCommand extends Command
{
    /**
     * El nombre y la firma del comando.
     *
     * @var string
     */
    protected $signature = 'notificacion:prueba {userId=1}';

    /**
     * La descripción del comando.
     *
     * @var string
     */
    protected $description = 'Enviar una notificación de prueba a un usuario';

    /**
     * Ejecutar el comando.
     */
    public function handle()
    {
        $userId = $this->argument('userId');
        $user = User::find($userId);

        if (!$user) {
            $this->error("No se encontró el usuario con ID {$userId}");
            return;
        }

        $user->notify(new NoticiaPrueba());

        $this->info("✅ Notificación de prueba enviada al usuario {$user->email}");
    }
}
