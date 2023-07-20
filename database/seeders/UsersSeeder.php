<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "gazole",
            'email' => "admin@gazole.com",
            'email_verified_at' => now(),
            'password' => Hash::make("password"),
        ])->assignRole('gazole');

        User::create([
            'name' => "bons",
            'email' => "admin@bons.com",
            'email_verified_at' => now(),
            'password' => Hash::make("password"),
        ])->assignRole('bons');
    }
}
