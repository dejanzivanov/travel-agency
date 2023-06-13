<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register()
    {
        if(Auth::check())
        {
            return redirect(route('home'));
        }
        return view('register');
    }

    public function registerPost(Request $request)
    {
        $data = new \stdClass();
        $data->message = "";
        $data->request = "";
        $data->link = "";


        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required',
        ]);


        $user = new User();
        $user->name = $request->name;
        $user->last_name = '';
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone;
        $user->account_type = 'user';

//        $user->email = $data['email'];
//        $user->password = $data['password'];
//        $user->phone_number = $data['phone'];
        $user->save();

        if (!$user)
        {
            $data->message = 'Something went wrong';
            $data->link = "register";
            return $data;
//            return redirect(route('register'))->with('error', 'Something went wrong');

        }
        $data->message = 'Registration successful';
        $data->link = "login";
        return $data;
//        return redirect(route('login'))->with('success', 'Registration successful');



    }
}
