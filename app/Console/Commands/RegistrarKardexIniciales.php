<?php

namespace App\Console\Commands;

use App\Models\Item;
use App\Models\ItemCategoria;
use App\Models\Kardex;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RegistrarKardexIniciales extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrar_kardexs_iniciales';

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

        $this->info('Iniciando el registro de kardex iniciales...');
        $this->info('Eliminando kardex existentes...');
        Kardex::truncate();

        $insumos = Item::with('stocks')
            ->whereHas('stocks', function ($query) {
                $query->where('cantidad', '>', 0);
            })
//            ->whereIn('categoria_id', [
//                ItemCategoria::FERRETERIA,
//                ItemCategoria::FARMACIA,
//            ])
            ->get();


        foreach ($insumos as $insumo) {

            $stockInicial = $insumo->stocks->first();

            $stockInicial->kardex()->forceCreate([
                'item_id' => $stockInicial->item_id,
                'categoria_id' => $insumo->categoria_id,
                'cantidad' => $insumo->stock_total,
                'tipo' => Kardex::TIPO_INGRESO,
                'codigo' => null,
                'responsable' => 'Existencia inicial según acta Administrativa 007-2025, de fecha 30 de septiembre',
                'usuario_id' => auth()->user()->id ?? User::PRINCIPAL,
                'created_at' => Carbon::now()->startOfMonth()
            ]);

        }

        $this->info('Kardex iniciales registrados exitosamente.');
    }
}
