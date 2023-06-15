<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{    public function getBlogDataFromController()
    {
//        $blog = new Blog();
        $data = Blog::getAllPosts();
        return view('blog', ['blog' => $data]);
    }

    public function getBlogDataFromControllerPostRequest()
    {
        $data = Blog::getAllPosts();
        return $data;
    }

    public function deleteBlogDataFromControllerPostRequest(Request $request)
    {
        $id = $request->input('id');
        $data = Blog::deletePost($id);
        return $data;
    }




}
