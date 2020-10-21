<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function calculate(Request $request){
        if ( $request->has('salary') && $request->has('status') ) {
            $salary = $request->salary;
            $status = $request->status;

            $relief = $this->getRelief($status);
            $nominal = ($salary * 12) - $relief;
            $tax = $this->getTax($nominal);

            return response()->json(['tax'=>$tax]);
        }

        return view('form');
    }

    function getRelief($status){
        $relief = 54000000;

        if ( $status == 'K0' ) {
            $relief = 58500000;
        } else if ( $status == 'K1' ) {
            $relief = 63000000;
        } else if ( $status == 'K2' ) {
            $relief = 67500000;
        } else if ( $status == 'K3' ) {
            $relief = 72000000;
        }

        return $relief;
    }

    function getTax($nominal){
        $tax = $nominal * 5 / 100;
        $firstRate = 50000000 * 5 / 100;

        if ( $nominal > 50000000  && $nominal <= 250000000) {
            $secondRate = ($nominal - 50000000) * 15 / 100;
            $tax = $firstRate + $secondRate;
        } else if ($nominal > 250000000 && $nominal <= 500000000) {
            $secondRate = 200000000 * 15 / 100;
            $thirdRate = ($nominal - 250000000) * 25 / 100;
            $tax = $firstRate + $secondRate + $thirdRate;
        } else if ($nominal > 500000000) {
            $secondRate = 200000000 * 15 / 100;
            $thirdRate = 250000000 * 25 / 100;
            $lastRate = ($nominal - 500000000) * 30 / 100;
            $tax = $firstRate + $secondRate + $thirdRate + $lastRate;
        }

        return $tax;
    }
}
