<?php

namespace App\Console\Commands;

use App\Imports\EnviarEnlaceUsuarios;
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

        $importable = new EnviarEnlaceUsuarios();

        $importable->import(  storage_path('imports/Listado de usuarios SEIC.xlsx'));


        $this->fin($importable->errores);

    }
}
