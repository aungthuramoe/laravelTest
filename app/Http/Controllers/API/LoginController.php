<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            Auth::login(Auth::user());
            return response()->json(Auth::user(), 200);
        }
    }

    public function logout()
    {
        Auth::logout();
    }
}
