<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
//    $blog =  new Blog();
//    $data = $blog->getAllPosts();
    public function getBlogDataFromController()
    {
        $blog = new Blog();
        $data = $blog->getAllPosts();
        return $data;
    }


}
