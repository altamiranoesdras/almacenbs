<?php

namespace App\Console\Commands;

use App\Imports\ImportColaboradores;
use App\Models\Activo;
use App\Models\ActivoTarjeta;
use App\Models\ActivoTarjetaDetalle;
use App\Models\Bodega;
use App\Models\Colaborador;
use App\Models\RrhhPuesto;
use App\Models\RrhhUnidad;
use App\Models\User;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPersonalCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:colaboradores';

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

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        Colaborador::truncate();
        User::where('id',">",5)->delete();
        Bodega::truncate();
        RrhhUnidad::truncate();
        RrhhPuesto::truncate();
        ActivoTarjeta::truncate();
        ActivoTarjetaDetalle::truncate();

        $importable = new ImportColaboradores();

        $importable->withOutput($this->output)->import(storage_path('imports/DIRECTORIO DE EMPLEADOS, SERVIDORES PÚBLICOS Y ASESORES SEICMSJ.xlsx'));

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
        $this->fin();
    }
}
