<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AnonimizarNombresUsuarios extends Command
{
    protected $signature = 'anonimizar:nombres-usuarios';
    protected $description = 'Baraja los nombres de los usuarios para proteger la identidad';

    public function handle()
    {
        $this->info('Obteniendo nombres originales...');

        $usuarios = User::select('id', 'name')
            ->whereNotIn('id', [1, 2, 3]) // Excluir IDs específicos
            ->get();
        $original = $usuarios->pluck('name')->values();
        $ids = $usuarios->pluck('id')->values();

        // Evitar que un nombre se mantenga en su mismo ID
        do {
            $barajado = $original->shuffle();
        } while ($original->zip($barajado)->filter(fn($pair) => $pair[0] === $pair[1])->isNotEmpty());

        $this->info('Actualizando nombres...');

        foreach ($ids as $index => $id) {
            $user = User::find($id);
            $user->name = $barajado[$index];
            $user->save();
        }

        $this->info('Nombres anonimizados correctamente.');
        return 0;
    }
}
