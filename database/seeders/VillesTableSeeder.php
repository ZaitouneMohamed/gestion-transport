<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VillesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('villes')->insert([
            "name" => "Rabat",
            "km_proposer" => 280
        ]);
        DB::table('villes')->insert([
            "name" => "Taza",
            "km_proposer" => 850
        ]);
        DB::table('villes')->insert([
            "name" => "Fés",
            "km_proposer" => 620
        ]);
        DB::table('villes')->insert([
            "name" => "Meknes",
            "km_proposer" => 580
        ]);
        DB::table('villes')->insert([
            "name" => "HOUSSAIMA",
            "km_proposer" => 1460
        ]);
        DB::table('villes')->insert([
            "name" => "OUJDA",
            "km_proposer" =>1340
        ]);
        DB::table('villes')->insert([
            "name" => "Tanger",
            "km_proposer" =>790
        ]);
        DB::table('villes')->insert([
            "name" => "Agadir",
            "km_proposer" =>1050
        ]);
        DB::table('villes')->insert([
            "name" => "Tetoune",
            "km_proposer" =>832
        ]);
        DB::table('villes')->insert([
            "name" => "Bni mellal",
            "km_proposer" =>490
        ]);
        DB::table('villes')->insert([
            "name" => "Casablanca",
            "km_proposer" =>100
        ]);
        DB::table('villes')->insert([
            "name" => "El jadida",
            "km_proposer" =>250
        ]);
        DB::table('villes')->insert([
            "name" => "Kenitra",
            "km_proposer" =>340
        ]);
        DB::table('villes')->insert([
            "name" => "Khouribga",
            "km_proposer" =>280
        ]);
        DB::table('villes')->insert([
            "name" => "Marrakech",
            "km_proposer" =>560
        ]);
        DB::table('villes')->insert([
            "name" => "nador",
            "km_proposer" =>1410
        ]);
        DB::table('villes')->insert([
            "name" => "ASFI",
            "km_proposer" =>560
        ]);
    }
}
