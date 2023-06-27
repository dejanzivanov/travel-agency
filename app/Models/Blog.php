<?php

namespace App\Models;

use App\Http\Controllers\FileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;


class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['author'];


    public static function fetchDatatableResult($sorting_column, $sorting_direction, $offset, $length, $search)
    {
        $data = DB::table('posts')
            ->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')
            ->orWhere('id', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('type', 'LIKE', '%' . $search . '%')
            ->orWhere('status', 'LIKE', '%' . $search . '%')
            ->orderBy($sorting_column, $sorting_direction)
            ->offset($offset)
            ->limit($length)
            ->get();

        $data_filtered = DB::table('posts')
            ->where('title', 'LIKE', '%' . $search . '%')
            ->orWhere('author', 'LIKE', '%' . $search . '%')
            ->orWhere('id', 'LIKE', '%' . $search . '%')
            ->orWhere('description', 'LIKE', '%' . $search . '%')
            ->orWhere('type', 'LIKE', '%' . $search . '%')
            ->orWhere('status', 'LIKE', '%' . $search . '%')
            ->orderBy($sorting_column, $sorting_direction)
            ->select('id', 'author', 'created_at', 'published_at', 'title', 'description', 'bodyText', 'image', 'type', 'status')
            ->get();

        $recordsTotal = DB::table('posts')->count();


        return [
            'recordsFiltered' => count($data_filtered),
            'recordsTotal' => $recordsTotal,
            'data' => $data
        ];
    }

    public static function updateBlog(\Illuminate\Http\Request $request)
    {
//        dd($request->all());


        $arr = [
            'author' => Auth::user()->name,
            'title' => $request->title,
            'description' => $request->description,
            'bodyText' => $request->bodyText,
            'type' => strtolower($request->type),
            'status' => $request->status,
            'published' => $request->published,
        ];


        $status = $request->status;
        $currentTime = Carbon::now();
        $formated_time = Carbon::parse($currentTime)->toDateTimeString();
//        dd($formated_time);


        switch ($request->status) {
            case 'published':
                $arr['published_at'] = $formated_time;
                $arr['archived_at'] = null;
                break;
            case 'archived':
                $arr['published_at'] = null;
                $arr['archived_at'] = $formated_time;
                break;
            default:
                unset($arr['published_at']);
                unset($arr['archived_at']);
        }

        $data = DB::table('posts')->where('id', $request->id)->update($arr);
        return $data;
    }

    public static function saveImageNameById($id, $name)
    {
        $arr = [];
        array_push($arr, $name);
        array_push($arr, $id);
        $data = DB::update("UPDATE `posts` SET `image` = ? WHERE `id` = ?;", $arr);
        return $data;

    }

    public static function createPost(\Illuminate\Http\Request $request)
    {
        $blog = new Blog();
        $status_field = '';

        switch($request->status)
        {
            case 'in_preparation':
                $status_field = 'created_at';
                break;
            default:
                $status_field = '';
        }

        $id = DB::table('posts')->insertGetId([
            'author' => Auth::user()->name,
            'title' => $request->title,
            'description' => $request->description,
            'bodyText' => $request->bodyText,
            'type' => strtolower($request->type),
            'status' => $request->status,
            $status_field => Carbon::now()->toDateTimeString()
        ]);
        $request->id = $id;

        FileController::upload($request);



//        $responseData = [
//            'name' => 'John Doe',
//            'email' => 'johndoe@example.com'
//        ];

//        Throw
//        http_response_code(400);

//        try
//        {
//        $response = [
//            'code' => http_response_code(201),// Get the current HTTP response code
////            'message' => Blog::getServerMessage(http_response_code()), // Retrieve the server message based on the code
//            'message' => Response::$statusTexts[http_response_code()], // Retrieve the server message based on the code
//            'data' => $responseData
//        ];
//        return response()->json($response);


//                try
//        {
////            $post = Post::getPostById($request);
//                            $responseData = [
//            'name' => 'John Doe',
//            'email' => 'johndoe@example.com'
//        ];
//            return response()->json([
//                'message' => 'success',
////                200,
//                http_response_code()->,
//                'data' => $responseData
//            ]);
//        } catch (\Exception $ex) {
//            return response()->json([
//                'message' => $ex->getMessage(),
//                $ex->getCode()
//            ]);
//        }

    }

    public function getAllPosts()
    {
        $data = DB::select((DB::raw("SELECT * FROM `posts`;")));
        return $data;
    }

    public function deletePost($id)
    {
        $arr = [];
        array_push($arr, $id);
        $data = DB::delete("DELETE FROM `posts` WHERE `id` = ?;", $arr);
        return $data;
    }

    public function findPostById($id)
    {
        $arr = [];
        array_push($arr, $id);
        $data = DB::table('posts')
            ->where('id', '=', $arr)
            ->get()
        ->toArray();
        $filename = $data[0]->image;
//        dd($filename);
        $publicPath = asset('/storage/uploads/' . $data[0]->id . '/' .  $filename);
        $data[0]->image = $publicPath;
//        dd($publicPath);
        return $data;
    }
}
