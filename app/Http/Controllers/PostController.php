<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public static function returnViewPost(Request $request)
    {
        return view('post-preview');
    }
}
