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

    public static function getPostById(Request $request)
    {
        $post = Post::getPostById($request);
        if($post)
        {
            return response()->json([
                'message' => 'success',
                200

            ]);
        }


//        try
//        {
//            $post = Post::getPostById($request);
//            return response()->json([
//                'message' => 'success',
//                200
//            ]);
//        } catch (\Exception $ex) {
//            return response()->json([
//                'message' => $ex->getMessage(),
//                $ex->getCode()
//            ]);
//        }




        return view('post', ['post' => $post]);
    }
}
