<?php

namespace App\Console\Commands;

use App\Models\Bodega;
use App\Traits\ComandosTrait;
use Illuminate\Console\Command;

class AsociarBodegaUnidadCommand extends Command
{

    use ComandosTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:asociar-bodega-unidad';

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

        Bodega::query()->update(['rrhh_unidade_id' => null]);

        $unidades = \App\Models\RrhhUnidad::areas()->solicitan()->get();
        $unidadesNoAsociadas = collect();

        foreach ($unidades as $unidad) {
            $bodega = \App\Models\Bodega::query()
                ->where('nombre',$unidad->nombre )
                ->first();

            if ($bodega) {
                $bodega->rrhh_unidade_id = $unidad->id;
                $bodega->save();
            } else {
                $unidadesNoAsociadas->push($unidad);
            }
        }

        //tabal de las bodegas que no se pudieron asociar
        if ($unidadesNoAsociadas->isNotEmpty()) {
            $this->error('Las siguientes bodegas no se pudieron asociar:');
            $this->table(
                ['ID', 'Nombre'],
                $unidadesNoAsociadas->map(function ($unidad) {
                    return [
                        'ID' => $unidad->id,
                        'Nombre' => $unidad->nombre,
                    ];
                })->toArray()
            );
        } else {
            $this->info('Todas las bodegas se asociaron correctamente.');
        }
    }
}
