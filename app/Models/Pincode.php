<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $table = 'pininfo';


    public function getAddress($pincode)
    {
       // $result = self::where('pincode',$pincode)->get();
        $addresses = $this->where('pincode',$pincode)->get();
        $result = ['taluk' => [], 'district' => []];

        foreach($addresses as $address)
        {
            $district = $address->district;
            $taluk = $address->taluk;

            if (!in_array($taluk, $result['taluk']))
            {
                array_push($result['taluk'],$taluk);
            }
            if (!in_array($district, $result['district']))
            {
                array_push($result['district'],$district);
            }

        }


        $statedetails = $addresses[0]->state;
        $result['statename'] = $statedetails['statename'];
        $result['statecode'] = $statedetails['statecode'];
        return response()->json($result);
    }


    public function getPincodes($district, $state)
    {
        $pincodes = $this->where([['district', $district],['statename',$state]]) -> pluck('pincode');

        return response()->json(['pincodes' => $pincodes]);
    }
    

    public function state()
    {
        return $this->belongsTo('App\Models\State', 'statename', 'statename');
    }
}
