<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    protected $primaryKey = 'statecode';
    public $incrementing = false;

   /* public function get($statecode)
    {
        $result = self::where('statecode', $statecode)->get();
        return response()->json($result);
    }*/


}
