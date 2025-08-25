<?php
namespace Database\Seeders;

use App\Models\CompraEstado;
use Illuminate\Database\Seeder;

class CompraEstadosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('compra_estados')->truncate();

        CompraEstado::create(['nombre' => 'TEMPORAL']);
        CompraEstado::create(['nombre' => 'PROCESADO / PENDIENTE DE RECIBIR']);
        CompraEstado::create(['nombre' => 'INGRESADO']);
        CompraEstado::create(['nombre' => '1H OPERADO']);
        CompraEstado::create(['nombre' => '1H APROBADO']);
        CompraEstado::create(['nombre' => '1H AUTORIZADO']);
        CompraEstado::create(['nombre' => 'RETORNO POR APROBADOR']);
        CompraEstado::create(['nombre' => 'RETORNO POR AUTORIZADOR']);
        CompraEstado::create(['nombre' => 'CANCELADO']);
        CompraEstado::create(['nombre' => 'ANULADO']);

    }
}
