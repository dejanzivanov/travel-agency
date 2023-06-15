<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Blog extends Model
{
    use HasFactory;

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
}
