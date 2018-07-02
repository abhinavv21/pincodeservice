<?php
namespace App\Services;

use App\Models\Pincode;
use App\Validations\PinValidator;

class PinService
{

    public function getAddress($pincode)
    {
        $valid = PinValidator::validatePin($pincode);
        if ($valid === false)
        {
            abort(400, 'invalid pincode');
        }
        else
        {
            $pincodeModel = new Pincode();
            $result = $pincodeModel->getAddress($pincode);
            return $result;
        }

    }

    public function getPincodes($request)
    {
        $district = $request->query('district');
        $state = $request->query('state');
        $valid_district = PinValidator::validateAddress($district);
        $valid_state = PinValidator::validateAddress($state);

        if ($valid_district === true and $valid_state === true)
        {
            $pincodeModel = new Pincode();
            $result = $pincodeModel->getPincodes($district, $state);
            return $result;
        }
        elseif ($valid_district === false and $valid_state === false)
        {
            abort(400, 'invalid state and district details ');
        }
        elseif ($valid_state === false)
        {
            abort(400, 'invalid state details ');

        }
        elseif ($valid_district === false)
        {
            abort(400, 'invalid district details ');
        }


    }






}