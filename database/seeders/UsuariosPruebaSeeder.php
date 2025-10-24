<?php

namespace Database\Seeders;

use App\Models\Bodega;
use App\Models\Option;
use App\Models\Role;
use App\Models\RrhhUnidad;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsuariosPruebaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        deshabilitaLlavesForaneas();

        User::whereIn('username', [
            'requirente1',
            'autorizador1',
            'despachador'
        ])->forceDelete();

        $unidadConStock = RrhhUnidad::whereHas('stocks', function ($query) {
            $query->where('cantidad', '>', 0);
        })->first();

        $bodegaConStock = Bodega::where('id','!=', Bodega::PRINCIPAL)->first();

        User::factory(1)->create([
            "username" => "requirente1",
            "name" => "Solicitante Requisición Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => $unidadConStock->id,
            'bodega_id' => $bodegaConStock->id,
        ])->each(function (User $user){
            $user->syncRoles(Role::SOLICITANTE_REQUISICION_ALMACEN);

            $opciones =[
                Option::NUEVA_REQUISICION_ALMACEN,
                Option::MIS_REQUISICIONES_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);
        });


        User::factory(1)->create([
            "username" => "autorizador1",
            "name" => "Autorizador Requisiciones Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => $unidadConStock->id,
            'bodega_id' => $bodegaConStock->id,
        ])->each(function (User $user) {
            $user->syncRoles(Role::AUTORIZADOR_REQUISICION_ALMACEN);

            $opciones =[
                Option::AUTORIZAR_REQUISICION_ALMACEN,
                Option::BUSCAR_REQUISICION_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);
        });

        User::factory(1)->create([
            "username" => "despachador",
            "name" => "Despachador Requisiciones Almacén",
            "password" => bcrypt("123"),
            'unidad_id' => RrhhUnidad::ALMACEN,
            'bodega_id' => Bodega::PRINCIPAL,
            'puesto_id' => null,
        ])->each(function (User $user){
            $user->syncRoles(Role::AUTORIZADOR_REQUISICION_ALMACEN);

            $opciones = [
                Option::DESPACHAR_REQUISICION_ALMACEN,
                Option::BUSCAR_REQUISICION_ALMACEN,
            ];

            $user->options()->sync($opciones);
            $user->shortcuts()->sync($opciones);

        });


    }
}
