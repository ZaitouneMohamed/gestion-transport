<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCamionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $camions = [
            ["11878 A 13"],
            ["12208 A 13"],
            ["33585 A 13"],
            ["12558 A 72"],
            ["30842 13"],
            ["28101 A 7"],
            ["86697 B 8"],
            ["32324  A 13"],
            ["46248  A 13"],
            ["46249 A 13"],
            ["42786 A 13"],
        ];
    }
}
