<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinupdates extends Model
{
    protected $table = 'pinupdates';

    public function setter()
    {
        $this->save();
    }
    public function getter()
    {
        //self::orderBy('created_at', 'desc')->first();
        return $this->all()->last()->created_at;
    }
}
