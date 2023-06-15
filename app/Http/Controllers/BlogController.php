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

    public function getBlogDataFromControllerPostRequest(Request $request)
    {
//        dd($request->all());
        // draw,

//        $data['draw'] = $request->draw;
//        if($request->recordsTotal == null or $request->recordsTotal== '')
//            $data['recordsTotal'] = 1;
//        else
//            $data['recordsTotal'] = $request->recordsTotal;
//
//        if($request->recordsFiltered == null or $request->recordsFiltered == '')
//            $data['recordsFiltered'] = 1;
//        else
//            $data['recordsFiltered'] = $request->recordsFiltered;




        $data['data'] = Blog::getAllPosts();
        $data['recordsTotal'] = count($data['data']);
        $data['recordsFiltered'] = 3;
        $data['draw'] = $request->draw;
        $index = 0;

        //additional variables from the datatable

        switch($request['order'][0]['column']){
            case '0':
                 $index = 0;
                break;
            case '1':
                $index = 1;
                break;
            case '2':
                $index = 2;
                break;
            default:
                break;
        }

//        $sorting_column = $request['order'][$index]['column'];
//        $offset = $request['start'];
//        $limit = $request['length'];
//        $search = $request['search']['value'];
//        $sorting_direction = $request['order'][0]['dir']; //ascending or descending order
//
        $sql_result = Blog::fetchDatatableResult($sorting_column, $sorting_direction, $offset, $length, $status)

//        offset - starts
//        (limit length)

//        $data = Blog::getAllPosts();
//        dd($data);

        return json_encode($data);
    }

    public function deleteBlogDataFromControllerPostRequest(Request $request)
    {
//        dd($request->all());
        $id = $request->post_id;
        $data = Blog::deletePost($id);
        return $data;
    }




}
