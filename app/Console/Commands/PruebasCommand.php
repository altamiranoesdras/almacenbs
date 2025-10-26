<?php

namespace App\Console\Commands;

use App\Models\Departamento;
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
        $departamentos = Departamento::with('municipios')->get();
        dd($departamentos->toArray());
    }
}
