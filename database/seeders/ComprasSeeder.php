<?php

namespace Database\Seeders;

use App\Models\Compra;
use App\Models\Compra1h;
use App\Models\CompraDetalle;
use App\Models\Kardex;
use App\Models\Stock;
use App\Models\StockTransaccion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        deshabilitaLlavesForaneas();

        // Limpiar tablas
        CompraDetalle::truncate();
        StockTransaccion::truncate();
        Stock::truncate();
        Kardex::truncate();
        Compra1h::truncate();
        Compra::truncate();

        DB::transaction(function () {

            $compras = Compra::factory()
                ->count(25)
                ->state(new Sequence(
                    [
                        'created_at' => now()->startOfMonth()->subDays(rand(1, 7)),
                        'fecha_documento' => now()->startOfMonth()->subDays(rand(1, 7)),
                        'fecha_ingreso' => now()->startOfMonth()->subDays(rand(1, 7)),
                    ],
                    [
                        'created_at' => now()->startOfMonth()->addDays(rand(1,7)),
                        'fecha_documento' => now()->startOfMonth()->addDays(rand(1, 7)),
                        'fecha_ingreso' => now()->startOfMonth()->addDays(rand(1, 7)),
                    ],
                ))
                ->has(
                    CompraDetalle::factory()
                        ->state(new Sequence(
                            ['cantidad' => 25, 'precio' => 6],
                            ['cantidad' => 50, 'precio' => 7]
                        ))
                        ->count(rand(3,8)),
                    'detalles'
                )
                ->afterCreating(function (Compra $compra) {
                    // Procesar ingreso y generar 1h para cada compra
                    $compra->procesaIngreso();
                    $compra->genera1h($compra->correlativo + 10000);
                })
                ->create();

        });
    }
}
