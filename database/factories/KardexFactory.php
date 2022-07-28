<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Kardex;
use App\Models\Tienda;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'tienda_id' => Tienda::all()->random()->id,
        'kardexable_id' => $faker->randomDigitNotNull,
        'kardexable_type' => $faker->word,
        'cantidad' => $faker->randomDigitNotNull,
        'tipo' => $faker->randomElement([Kardex::TIPO_INGRESO,Kardex::TIPO_SALIDA]),
        'codigo' => $faker->randomDigitNotNull,
        'responsable' => null,
        'user_id' => User::all()->random()->id
    ];
});
