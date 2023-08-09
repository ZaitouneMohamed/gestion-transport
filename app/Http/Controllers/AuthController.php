<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function Login_form()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('gazole')) {
                return redirect("/admin");
            } else {
                return redirect('/bons');
            }
        } else {
            return view('auth.login');
        }
    }

    function login(LoginRequest $request)
    {
        if (auth()->attempt([
            "email" => $request->email,
            "password" => $request->password
        ])) {
            return redirect("/admin");
        } else {
            return redirect('/login')->with([
                "error" => "these information do not match any one of our records"
            ]);
        }
    }

    function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
