<?php

namespace App\Http\Controllers;

use App\Models\Dependents;
use Illuminate\Http\Request;

class DependentsController extends Controller
{
    //

    public function getDependentsByID($id)
    {
        $data = Dependents::getDependentsByID($id);
        return $data;
    }

    public function dependentsView(Request $request)
    {
        return view('dependents', ['id' => $request['id']]);
    }
}
