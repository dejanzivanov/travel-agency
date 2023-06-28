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
////        return redirect(route('/home'));
//        $data = new \stdClass();
//        $data->message = "";
//        $data->request = "";
//        $data->link = "";
//
//        $request->validate([
//            'email' => 'required',
//            'password' => 'required'
//        ]);
//
//        $credentials = $request->only('email', 'password');
//
//        if (Auth::attempt($credentials)) {
//            $data->message = "Login successful";
//            $data->link = "/";
//            return $data;
//            echo "Login successfuldsaaaaaaaaaaaaaa";
//        }
//        else
//        {
////            $data->error = "Login fail";
////            $data->link = "register";
//
//            return response()->json(['error' => 'Wrong Credentials'], 401);
//        }
        $response = [
            'message' => '',
            'link' => '',
        ];

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $response['message'] = 'Login successful';
            $response['link'] = '/admin-dashboard';
            return response()->json($response, 200);
        } else {
            $response['error'] = 'Wrong credentials';
            return response()->json($response, 401);
        }




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
