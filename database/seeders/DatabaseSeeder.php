<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(VillesTableSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(UsersSeeder::class);
        // // \App\Models\User::factory(10)->create();
        // \App\Models\Camion::factory(10)->create();
        // \App\Models\Chaufeur::factory(10)->create();
        // \App\Models\Station::factory(10)->create();
    }
}
