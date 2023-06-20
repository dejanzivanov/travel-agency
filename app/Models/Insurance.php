<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Insurance extends Model
{
    use HasFactory;

    public static function purchaseInsurance(\Illuminate\Http\Request $request)
    {
//        dd($request->all());
        $name = $request->name;
        $lastName = $request->lastName;
        $phone_number = $request->phoneNumber;
        $policy_type = $request->policyType;
        $holiday_date_from = Carbon::parse($request->holidayDate[0])->toDateString();
        $holiday_date_to = Carbon::parse($request->holidayDate[1])->toDateString();
        $group_members = $request->groupMembers;

        $id = DB::table('policy_holder')->insertGetId(
            [
                'name' => $name,
                'last_name' => $lastName,
                'phone_number' => $phone_number,
                'type' => $policy_type,
                'journey_start' => $holiday_date_from,
                'journey_end' => $holiday_date_to,
            ]
        );

        if($policy_type == 'group')
        {
            foreach ($group_members as $member)
            {
                DB::table('dependents')->insert(
                    [
                        'id' => $id,
                        'name' => $member['name'],
                        'last_name' => $member['lastName'],
                        'date_of_birth' => Carbon::parse($member['dateOfBirth'])->toDateString(),
                    ]
                );
            }
        }

        return $id;
    }

    public static function getAllInsurancesPostRequestDataTable(Request $request)
    {
//        $data['data'] = Insurance::getAllInsurances();

        $sorting_column_string = '';
switch($request['order'][0]['column']){
            case '0':
                $sorting_column_string = 'id';
                break;
            case '1':
                $sorting_column_string = 'name';
                break;
            case '2':
                $sorting_column_string = 'last_name';
                break;
            case '3':
                $sorting_column_string = 'phone_number';
                break;
            case '6':
                $sorting_column_string = 'type';
                break;
            default:
                break;
        }

        $sorting_column = $sorting_column_string;
        $offset = $request['start'];
        $limit = $request['length'];
        $search = $request['search']['value'];
        $sorting_direction = $request['order'][0]['dir']; //ascending or descending order
        $sql_result = Insurance::fetchDatatableResult($sorting_column, $sorting_direction, $offset, $limit, $search);
        $data['data'] = $sql_result['data'];
//        dd($sql_result['data']);
        $data['recordsTotal'] = $sql_result['recordsTotal'];
        $data['recordsFiltered'] = $sql_result['recordsFiltered'];
        $data['draw'] = $request['draw'];


        return json_encode($data);
    }

    private function fetchDataTableResult($sorting_column, $sorting_direction, $offset, $limit, $search)
    {
//        $sql = "SELECT * FROM policy_holder WHERE name LIKE '%$search%' OR last_name LIKE '%$search%' OR phone_number LIKE '%$search%' OR type LIKE '%$search%' ORDER BY $sorting_column $sorting_direction LIMIT $offset, $limit";
//        $sql_result = DB::select($sql);

        $data = DB::table('policy_holder')
            ->where('name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('phone_number', 'like', '%'.$search.'%')
            ->orWhere('type', 'like', '%'.$search.'%')
            ->orderBy($sorting_column, $sorting_direction)
            ->offset($offset)
            ->limit($limit)
            ->get();

        $data_filtered = DB::table('policy_holder')
            ->where('name', 'like', '%'.$search.'%')
            ->orWhere('last_name', 'like', '%'.$search.'%')
            ->orWhere('phone_number', 'like', '%'.$search.'%')
            ->orWhere('type', 'like', '%'.$search.'%')
            ->orderBy($sorting_column, $sorting_direction)
            ->select('id', 'name', 'last_name', 'phone_number', 'type')
            ->get();

        $records_total = DB::table('policy_holder')->count();

        return [
            'data' => $data,
            'recordsTotal' => $records_total,
            'recordsFiltered' => count($data_filtered),
        ];
    }

    public static function getDependents(Request $request)
    {
        $id = $request->id;
        $data = DB::table('dependents')->where('id', $id)->get();
        return $data;
    }
}
