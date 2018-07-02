<?php

namespace App\Validations;

class PinValidator
{
    const PIN_UPPER_LIMIT = 859999;
    CONST PIN_LOWER_LIMIT = 110000;

    public static function validatePin($pincode)
    {

        if (($pincode > self::PIN_UPPER_LIMIT) or
            ($pincode < self::PIN_LOWER_LIMIT))
        {
            return false;
        }

        return true;
    }

    public static function validateAddress($address)
    {


        if (!preg_match('/[^A-Za-z\ ]/', $address))
        {
                return true;
        }

        return false;
    }

}