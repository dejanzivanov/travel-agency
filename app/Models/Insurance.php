<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
