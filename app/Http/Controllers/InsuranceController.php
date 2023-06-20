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
//        dd($request->all());
//       dd($request->all(), $request->policyType, $request['groupMembers']);
//        $request->validate([
//            'insurance' => 'required',
//        ]);

        $data = Insurance::purchaseInsurance($request);
        return $data;
        //        return redirect()->route('insurance')->with('success', 'Insurance purchased successfully.');

    }
}
