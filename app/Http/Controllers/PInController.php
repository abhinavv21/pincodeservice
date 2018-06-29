<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pincode;


class PinController extends Controller
{
    /**
     * get information assocaited with the pincode.
     *
     * @param  int  $pincode
     * @return Response
     */
    public function getAddress($pincode)
    {
        $pincodeModel = new Pincode();
        $result = $pincodeModel->getAddress($pincode);
        return $result;

    }
    public function getPincodes(Request $request)
    {
        $pincodeModel = new Pincode();
        $district = $request->query('district');
        $state = $request->query('state');
        $result = $pincodeModel->getPincodes($district, $state);
        return $result;
    }
}