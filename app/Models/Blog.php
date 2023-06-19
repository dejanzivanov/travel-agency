<?php

namespace App\Models;

use App\Http\Controllers\FileController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['author'];


    public static function fetchDatatableResult($sorting_column, $sorting_direction, $offset, $length, $search)
    {
//        $data = DB::select((DB::raw("SELECT * FROM `posts` WHERE `title` LIKE '%$search%' ORDER BY `$sorting_column` $sorting_direction LIMIT $offset, $length;")));
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

//        dd("SELECT * FROM `posts` WHERE `title` LIKE '%$search%' ORDER BY `$sorting_column` $sorting_direction LIMIT $offset, $length;");
//        $data_filtered = DB::select((DB::raw("SELECT * FROM `posts` WHERE `title` LIKE '%$search%' ORDER BY `$sorting_column` $sorting_direction")));
//        $recordsTotal = count(DB::select((DB::raw("SELECT * FROM `posts`"))));
//        dd($data);
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
//        $arr = [];
//        array_push($arr, Auth::user()->name);
//        array_push($arr, $request->title);
//        array_push($arr, $request->description);
//        array_push($arr, $request->bodyText);
//        array_push($arr, $request->image);
//        array_push($arr, strtolower($request->type));
//        array_push($arr, $request->status);
//        array_push($arr, $request->id);
//        $data = DB::update("UPDATE `posts` SET `author` = ?, `title` = ?, `description` = ?, `bodyText` = ?, `image` = ?, `type` = ?, `status` = ?,   WHERE `id` = ?;", $arr);
//        return $data;
        $arr = [
            'author' => Auth::user()->name,
            'title' => $request->title,
            'description' => $request->description,
            'bodyText' => $request->bodyText,
            'image' => $request->image,
            'type' => strtolower($request->type),
            'status' => $request->status,
        ];

        $status = $request->status;
        $currentTime = Carbon::now();
        $formated_time = $currentTime->toDateTimeString();


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
//        dd($request->all());
        $blog = new Blog();

        $status_field = '';

        switch($request->status)
        {
            case 'published':
                $status_field = 'published_at';
                break;
            case 'archived':
                $status_field = 'archived_at';
                break;
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
        return $data;
    }
}
