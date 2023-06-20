<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use Illuminate\Http\Request;

class InsuranceController extends Controller
{
    public function insurance()
    {
        return view('insurance-purchase');
    }

    public function insurancePurchase(Request $request)
    {
        $data = Insurance::purchaseInsurance($request);
        return $data;
    }

    public function getAllInsurancesPostRequestDataTable(Request $request)
    {
        $data = Insurance::getAllInsurancesPostRequestDataTable($request);
//        dd($data);
        return $data;
    }


}
