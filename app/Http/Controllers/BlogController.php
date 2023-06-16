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
//        $data['recordsTotal'] = count($data['data']);
//        $data['recordsFiltered'] = 3;
        $index = 0;

        //additional variables from the datatable
        $sorting_column_string = '';

        switch($request['order'][0]['column']){
            case '0':
//                 $index = 0;
                $sorting_column_string = 'id';
                break;
            case '1':
//                $index = 1;
                $sorting_column_string = 'author';
                break;
            case '6':
                $sorting_column_string = 'title';
                break;
            case '8':
                $sorting_column_string = 'type';
                break;
            case '7':
                $sorting_column_string = 'status';
                break;
            case '9':
                $sorting_column_string = 'description';
                break;
            default:
                break;
        }

        $sorting_column = $sorting_column_string;
        $offset = $request['start'];
        $limit = $request['length'];
        $search = $request['search']['value'];
        $sorting_direction = $request['order'][0]['dir']; //ascending or descending order
//
        $sql_result = Blog::fetchDatatableResult($sorting_column, $sorting_direction, $offset, $limit, $search);


//        offset - starts
//        (limit length)

//        $data = Blog::getAllPosts();
//        dd($data);
        $data['data'] = $sql_result['data'];
        $data['recordsTotal'] = $sql_result['recordsTotal'];
        $data['recordsFiltered'] = $sql_result['recordsFiltered'];
        $data['draw'] = $request->draw;

        return json_encode($data);
    }

    public function deleteBlogDataFromControllerPostRequest(Request $request)
    {
//        dd($request->all());
        $id = $request->post_id;
        $data = Blog::deletePost($id);
        return $data;
    }

    public function updateBlogDataFromControllerPostRequest(Request $request)
    {
        return view('blog-data-update', ['id' => $request->id]);
    }

    //find post by id

    public function findPostById($id)
    {
        $data = Blog::findPostById($id);
        return $data;
    }




}
