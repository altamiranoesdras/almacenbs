<?php

namespace App\Console\Commands;

use App\Imports\ImportColaboradores;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

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

        $importable = new ImportColaboradores();

        $importable->withOutput($this->output)->import(public_path('imports/LISTADO DE PERSONAL NOVIEMBRE 2022.xlsx'));

        $this->fin();
    }
}
