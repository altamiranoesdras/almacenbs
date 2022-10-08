<?php

namespace Database\Seeders;

use App\Models\EnvioFiscal;
use Database\Factories\EnvioFiscalFactory;
use Illuminate\Database\Seeder;

class EnvioFiscalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EnvioFiscal::factory()->count(5)->create();

    }
}
