<?php

namespace Database\Seeders;

use App\Models\Natures;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $natures = [
            [
                'name' => 'gazole',
                'type' => 'bons'
            ],
            [
                'name' => 'Autoroute',
                'type' => 'bons'
            ],
            [
                'name' => 'Autre',
                'type' => 'bons'
            ],
            [
                'name' => 'Achat Piece',
                'type' => 'bons'
            ],
            [
                'name' => 'Huile',
                'type' => 'bons'
            ],
            [
                'name' => 'Sayah',
                'type' => 'bons'
            ],
            [
                'name' => 'Espece',
                'type' => 'bons'
            ],
            [
                'name' => 'Credit',
                'type' => 'bons'
            ],
            [
                'name' => 'Amandes',
                'type' => 'bons'
            ],
            [
                'name' => 'Hakim',
                'type' => 'bons'
            ],
            [
                'name' => 'Lavage',
                'type' => 'bons'
            ],
        ];

        foreach ($natures as $nature) {
            Natures::create($nature);
        }
    }
}
