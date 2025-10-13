<?php

namespace Database\Seeders;

use App\Models\Bitacora;
use App\Models\Bodega;
use App\Models\Compra;
use App\Models\Compra1h;
use App\Models\Compra1hDetalle;
use App\Models\CompraDetalle;
use App\Models\CompraEstado;
use App\Models\Kardex;
use App\Models\RrhhUnidad;
use App\Models\Solicitud;
use App\Models\SolicitudDetalle;
use App\Models\SolicitudEstado;
use App\Models\Stock;
use App\Models\StockTransaccion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\Sequence;

class ComprasSeeder extends Seeder
{
    public function run()
    {
        deshabilitaLlavesForaneas();

        // Limpiar tablas
        Compra::truncate();
        CompraDetalle::truncate();

        StockTransaccion::truncate();
        Stock::truncate();
        Kardex::truncate();

        Compra1hDetalle::truncate();
        Compra1h::truncate();

        DB::table('solicitudes')->truncate();
        DB::table('solicitud_detalles')->truncate();

        Bitacora::truncate();

        DB::transaction(function () {

            $compras = Compra::factory()
                ->count(10)
                ->state(new Sequence(
                    ['estado_id' => CompraEstado::PROCESADO_PENDIENTE_RECIBIR],
                    ['estado_id' => CompraEstado::INGRESADO],
                    ['estado_id' => CompraEstado::UNO_H_OPERADO],
                    ['estado_id' => CompraEstado::UNO_H_APROBADO],
                    ['estado_id' => CompraEstado::UNO_H_AUTORIZADO],
                    ['estado_id' => CompraEstado::RETORNO_POR_APROBADOR],
                    ['estado_id' => CompraEstado::RETORNO_POR_AUTORIZADOR],
                    ['estado_id' => CompraEstado::CANCELADO],
                    ['estado_id' => CompraEstado::ANULADO],
                ))
                ->state(new Sequence(
//                    [
//                        'created_at' => now()->startOfMonth()->subDays(rand(1, 7)),
//                        'fecha_documento' => now()->startOfMonth()->subDays(rand(1, 7)),
//                        'fecha_ingreso' => now()->startOfMonth()->subDays(rand(1, 7)),
//                    ],
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

//                    if ($compra->estaRecibida()){
//                        $compra->procesaIngreso();
//                    }

                    if ($compra->estaOperado1h()){
                        sleep(1);
                        $compra->genera1h();
                        sleep(1);
                        $compra->operar1h();
                    }

                    if ($compra->estaAprobado1h()){
                        sleep(1);
                        $compra->genera1h();
                        sleep(1);
                        $compra->operar1h();
                        sleep(1);
                        $compra->aprobar1h();
                    }

                    if ($compra->estaAutorizado1h()){
                        sleep(1);
                        $compra->genera1h();
                        sleep(1);
                        $compra->operar1h();
                        sleep(1);
                        $compra->aprobar1h();
                        sleep(1);
                        $compra->autorizar1h();
                    }

                    if($compra->estaAnulada()){
                        sleep(1);
                        $compra->genera1h();
                        sleep(1);
                        $compra->operar1h();
                        sleep(1);
                        $compra->aprobar1h();
                        sleep(1);
                        $compra->autorizar1h();
                        sleep(1);
                        $compra->anular();
                    }

                })
                ->create();

        });
    }

    //crear una solicitud con la mitad de la cantidad comprada
    public function egreso(Compra $compra)
    {

        $correlativo = $compra->correlativo + 10000;

        $solicitud = Solicitud::create([
            'codigo' => "REQ-" . prefijoCeros($correlativo, 4) . "-" . Carbon::now()->year,
            'correlativo' => $correlativo,
            'justificacion' => 'Prueba de requisición de almacén',
            'unidad_id' => RrhhUnidad::all()->random()->id,
            'bodega_id' => Bodega::PRINCIPAL,

            'usuario_crea' => auth()->user()->id ?? User::PRINCIPAL,
            'usuario_solicita' => auth()->user()->id ?? User::PRINCIPAL,
            'estado_id' => SolicitudEstado::INGRESADA,
        ]);



        foreach ($compra->detalles as $detalle) {
            $cantidad = intval($detalle->cantidad / 2);
            if ($cantidad > 0) {
                SolicitudDetalle::create([
                    'solicitud_id' => $solicitud->id,
                    'item_id' => $detalle->item_id,
                    'cantidad_solicitada' => $cantidad,
                    'cantidad_autorizada' => $cantidad,
                    'cantidad_despachada' => $cantidad,
                    'precio' => $detalle->precio,
                ]);
            }
        }

        $solicitud->solicitar();
        $solicitud->autorizar();
        $solicitud->aprobar();
        $solicitud->despachar();

    }
}
