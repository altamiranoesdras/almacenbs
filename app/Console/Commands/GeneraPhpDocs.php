<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GeneraPhpDocs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generar:phpdocs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $modelos = collect(scandir(app_path('Models')))
            ->filter(function($modelo){
                return $modelo != '.' && $modelo != '..';
            })->map(function($modelo){
                return 'App\\Models\\'.str_replace('.php','',$modelo);
            })
            ->prepend('Todos')
            ->toArray();

        $modelos = array_values($modelos);



        //solicitar el modelo
        $modelo = $this->choice('Seleccione el modelo', $modelos, 0);

        $this->line("Generando phpdocs para el modelo $modelo");






        if ($modelo != 'Todos') {
            $this->call('ide-helper:models',[
                'model' => [$modelo],
                '--reset' => true,
                '--write' => true,
            ]);

        } else {


            $this->call('ide-helper:models',[
                '--reset' => true,
                '--write' => true,
            ]);

        }

        return 0;


    }
}
