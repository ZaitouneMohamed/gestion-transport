<?php

namespace Database\Seeders;

use App\Models\Chaufeur;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateChaufeurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $chaufeurs = [
            ["name" => "bouchaib"],
            ["name" => "atif"],
            ["name" => "amine"],
            ["name" => "benamer"],
            ["name" => "boussetta"],
            ["name" => "sadouki"],
            ["name" => "kanane"],
            ["name" => "bouchta"],
            ["name" => "dahmane"],
            ["name" => "boabdellah"],
            ["name" => "ghala"],
        ];
        foreach ($chaufeurs as $key => $chaufeur) {
            Chaufeur::create($chaufeur);
        }
    }
}
