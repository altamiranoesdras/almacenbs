<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call(PermissionsTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ConfigurationsTableSeeder::class);
        $this->call(OptionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');

    }
}
