<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function CreateNewUser(array $UserData)
    {
        User::create([
            "name"=>$UserData["name"],
            "email"=>$UserData["email"],
            "password"=>Hash::make($UserData["password"]),
        ])->assignRole($UserData["role"]);

        return "all good";
    }
}
