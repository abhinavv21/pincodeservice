<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    const PINCODE    =   'pincode';
    const TALUK      =   'taluk';
    const DISTRICT   =   'districtname';
    const STATENAME  =   'statename';
    const STATECODE  =   'statecode';

    protected $table = self::PINCODE;

    public function getAddress($pincode)
    {
        $addresses = $this->where(self::PINCODE,$pincode)->get();
        if ($addresses->count() === 0)
        {
            abort(404, 'pincode not found');
        }
        $result = [self::TALUK => [], self::DISTRICT => []];

        foreach($addresses as $address)
        {
            $district = $address->districtname;
            $taluk = $address->taluk;

            if (!in_array($taluk, $result[self::TALUK]))
            {
                array_push($result[self::TALUK],$taluk);
            }
            if (!in_array($district, $result[self::DISTRICT]))
            {
                array_push($result[self::DISTRICT],$district);
            }

        }

        $statedetails = $addresses[0]->state;
        $result[self::STATENAME] = $statedetails[self::STATENAME];
        $result[self::STATECODE] = $statedetails[self::STATECODE];

        return response()->json($result);
    }


    public function getPincodes($district, $state)
    {
        $pincodes = $this->where([[self::DISTRICT, $district],[self::STATENAME,$state]]) -> pluck(self::PINCODE)->unique();

        if ($pincodes->isEmpty() === true)
        {
            abort(404, 'no matching records found');
        }

        return response()->json(['pincodes' => $pincodes]);
    }
    

    public function state()
    {
        return $this->belongsTo('App\Models\State', self::STATENAME, self::STATENAME);
    }
}
