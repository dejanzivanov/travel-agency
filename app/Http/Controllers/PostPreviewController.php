<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostPreviewController extends Controller
{
    //
    public static function returnPostPreview(Request $request)
    {
//        dd($request->all());
        return view('post-preview');
    }
}
