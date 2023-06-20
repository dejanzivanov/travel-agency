<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dependents extends Model
{
    use HasFactory;

    public static function getDependentsByID($id)
    {
        $arr = [];
        array_push($arr, $id);
        $data = DB::table('dependents')
            ->where('id', '=', $arr)
            ->get();
//            ->toArray();
        return $data;
    }
}
