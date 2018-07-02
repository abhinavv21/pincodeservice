<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\PinService;
use App\Models\Pincode;
use App\Validations\PinValidator;

class PinServiceTest extends TestCase
{
    public function testPincode()
    {
        $pincodemodel = new Pincode();
        $result = $pincodemodel->getAddress('560040');
        $this->assertSame(json_encode([
            'taluk'          =>  ["Bangalore North"],
            'districtname'   =>  ["Bengaluru"],
            'statename'      =>  "karnataka",
            'statecode'      =>  "KA"
        ]), $result->getContent());
    }


    public function testValidatePin()
    {
        $this->assertFalse(PinValidator::validatePin('100'));
        $this->assertFalse(PinValidator::validatePin('9999999'));

    }


}


