<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public static function getPostById(Request $request)
    {
        return $post = DB::table('posts')
            ->where('id', $request->id)
            ->get();
    }
}
