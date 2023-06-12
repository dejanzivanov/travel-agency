<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials))
        {
            return redirect()->intended(route('home'));
        }

        return redirect(route('login'))->withErrors([
            'error' => 'The provided credentials do not match our records.',
        ]);

    }
}
