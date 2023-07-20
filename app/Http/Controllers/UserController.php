<?php

namespace App\Http\Controllers;

use App\Services\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected $userService;

    public function __construct(UserServices $userservice)
    {
        $this->userService = $userservice;
    }
    public function __invoke(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        $userData = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            "role" => $request->input('role')
        ];
        $user = $this->userService->CreateNewUser($userData);

        if (Auth::user()->hasRole('gazole')) {
            return redirect("/admin");
        }else {
            return redirect("/bons");
        }
    }
}
