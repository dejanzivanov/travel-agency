<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function login()
    {
        if(Auth::check())
        {
            return redirect(route('home'));
        }
        return view('login');
    }

    public function loginPost(Request $request)
    {
//        return redirect(route('/home'));
        $data = new \stdClass();
        $data->message = "";
        $data->request = "";
        $data->link = "";

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $data->message = "Login successful";
            $data->link = "/";
            return $data;
        }

        $data->message = "Login fail";
        $data->link = "register";
        return $data;

    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function logoutPost()
    {
        Session::flush();
        Auth::logout();
//        return redirect(route('login'));
    }
}
