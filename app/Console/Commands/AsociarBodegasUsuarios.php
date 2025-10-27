<?php

namespace App\Console\Commands;

use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class AsociarBodegasUsuarios extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:asociar-bodegas-usuarios';

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
        $this->inicio();

        $usuarios = \App\Models\User::query()->get();

        foreach ($usuarios as $usuario) {
            $bodega = $usuario->unidad->bodega->id ?? null;

            $usuario->bodega_id = $bodega;
            $usuario->save();

            if (!$bodega) {
                $this->error("El usuario {$usuario->name} no tiene una bodega asociada.");
            }
        }

        $this->info('Asociación de bodegas a usuarios completada.');
        $this->fin();

    }
}
