<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Services\PinService;


class PinController extends Controller
{
    /**
     * get information assocaited with the pincode.
     *
     * @param  int  $pincode
     * @return Response
     */
    public function getAddress($pincode, PinService $pinServiceInstance)
    {
        return $pinServiceInstance->getAddress($pincode);
    }

    /**
     * get pincodes given state and city details
     */
    public function getPincodes(Request $request, PinService $pinServiceInstance)
    {
        return $pinServiceInstance->getPincodes($request);
    }

}
