<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    use HasFactory;

    public static function purchaseInsurance(\Illuminate\Http\Request $request)
    {
        dd($request->all());
        $name = $request->name;
        $lastName = $request->lastName;
        $phone_number = $request->phoneNumber;
        $policy_type = $request->policyType;
        $group_members = $request->groupMembers;





    }
}
