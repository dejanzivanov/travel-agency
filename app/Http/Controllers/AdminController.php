<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public static function isAdmin(): bool
    {
        if(Auth::check())
        {
            if(Auth::user()->account_type == 'admin')
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        return false;
    }
}
