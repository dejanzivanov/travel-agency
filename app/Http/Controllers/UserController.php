<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function getAllUsersPostRequestDataTable(Request $request)
    {
//        $data = User::getAllUsersPostRequestDataTable($request);
//        dd($data);
        $sorting_column_string = '';
        switch($request['order'][0]['column']){
            case 0:
                $sorting_column_string = 'id';
                break;
            case 1:
                $sorting_column_string = 'name';
                break;
            case 2:
                $sorting_column_string = 'last_name';
                break;
            case 3:
                $sorting_column_string = 'email';
                break;
            case 5:
                $sorting_column_string = 'account_type';
                break;
            case 6:
                $sorting_column_string = 'phone_number';
                break;
            default:
                $sorting_column_string = 'id';
        }

        $sorting_column = $sorting_column_string;
        $offset = $request['start'];
        $limit = $request['length'];
        $search = $request['search']['value'];
        $sorting_direction = $request['order'][0]['dir']; //ascending or descending order
        $sql_result = User::fetchDatatableResult($sorting_column, $sorting_direction, $offset, $limit, $search);
        $data['data'] = $sql_result['data'];
//        dd($sql_result['data']);
        $data['recordsTotal'] = $sql_result['recordsTotal'];
        $data['recordsFiltered'] = $sql_result['recordsFiltered'];
        $data['draw'] = $request['draw'];


        return json_encode($data);
    }

    public function deleteUser(Request $request)
    {
        $data = User::deleteUser($request);
        return $data;
    }

    public function createUser(Request $request)
    {
        $data = User::createUser($request);
//        new User($data);
        return $data;
    }

    public function getUserDataById(Request $request)
    {
        $data = User::getUserDataById($request);
        return $data;
    }

    public function updateUser(Request $request)
    {
        $data = User::updateUser($request);
        return $data;
    }
}
