<?php

namespace App\Console\Commands;

use App\Traits\ComandosTrait;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SincronizarCapacitacionProduccion extends Command
{
    use ComandosTrait;

    private $fechaBackup;

    private $directorioDescarga;

    private $directorioExtrae;

    private $nombreAplicacionRemota = "almacenbs";
    private $nombreBaseDatos;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sincronizar_capacitacion_produccion';

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

        $this->fechaBackup = Carbon::now()->format('d-m-Y');

        $res = $this->call('backup:run', [
            '--only-db' => true,
            '--disable-notifications' => true,
            '--no-interaction' => true,
            '--filename' => $this->fechaBackup . '.zip',
        ]);

        dd($res);


    }
}
