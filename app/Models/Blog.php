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
//        dd('hello');
        $data = DB::select((DB::raw("SELECT * FROM `posts`;")));
        return $data;

    }
}
