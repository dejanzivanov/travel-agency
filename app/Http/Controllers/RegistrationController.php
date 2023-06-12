<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrationController extends Controller
{
    public function register()
    {
        return view('register');
    }

    public function registerPost($request)
    {
//        return view('registration');
        echo "Registration post";

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone_number' => 'required',
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = $request->password;
        $data['phone_number'] = Hash::make($request->phone_number);
        $user = User::create($data);

        if (!$user)
        {
            return redirect(route('register'))->with('error', 'Something went wrong');
        }
        return redirect(route('login'))->with('success', 'Registration successful');



    }
}
