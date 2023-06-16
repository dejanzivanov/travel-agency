<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

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
