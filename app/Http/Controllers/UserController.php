<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // protected $userService;

    // public function __construct(UserServices $userservice)
    // {
    //     $this->userService = $userservice;
    // }
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);
        if (Auth::user()->hasRole('gazole')) {
            $role = "gazole";
        }else {
            $role = "bons";
        }
        User::create([
            "name"=>$request->input('name'),
            "email"=>$request->input('email'),
            "password"=>Hash::make($request->input('password')),
        ])->assignRole($role);

        if (Auth::user()->hasRole('gazole')) {
            return redirect("/admin");
        }else {
            return redirect("/bons");
        }
    }
}
