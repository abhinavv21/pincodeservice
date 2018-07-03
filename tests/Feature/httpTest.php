<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\HttpException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class httpTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new Client();
    }

    public function tearDown()
    {
        $this->client = null;

    }

    public function testNormalGetAddressFlow()
    {
       // $client = new CLient();
        $response = $this->client->get('http://127.0.0.1:8000/pincode/560040');

        $this->AssertEquals($response->getStatusCode(),200);
        $this->assertSame(json_encode(
            [
            'taluk'          =>  ["Bangalore North"],
            'districtname'   =>  ["Bengaluru"],
            'statename'      =>  "karnataka",
            'statecode'      =>  "KA"
            ]), $response->getBody()->getContents());
    }

    public function testInvalidPin()
    {

        //$client = new CLient();
        $this->expectException("GuzzleHttp\Exception\ClientException");
        $this->client->get('http://127.0.0.1:8000/pincode/100');
    }

    public function testNormalGetPinFlow()
    {
        $response = $this->client->get('http://127.0.0.1:8000/address?district=bengaluru&state=karnataka');

        $this->AssertEquals($response->getStatusCode(),200);

        $this->assertSame(json_encode(
            [
            'pincodes' => [560103,560102,560076,560105,560001,560006,560007,560008,560016,560300,560017,560024,560025,560032,560036,560037,560043,560045,560047,560049,560063,560064,560075,560084,560094,560030,560056,560035,560018,560004,560026,560053,560034,560095,560098,560059,560070,560027,560085,560099,560061,560002,560050,560068,560078,560111,560011,560041,562106,562107,562149,562157,562125,562130,560009,560079,560040,560021,560010,560023,560086,560003,560055,560072,560096,560020,560104,560091,560073,560057,560013,560015,560054,560058,560012,560097,560022,560083,560029,560062,560100,560093,560071,560038,560067,560048,560087,560066,560046,560065,560080,560092,560005,560051,560077,560033,560042,560116,560117,560500,560081,560110,562162,560108,560109,560074,560113,560114,562164,560112,560115,560090,560060,560082]
            ]), $response->getBody()->getContents());

    }

    public function testInvalidState()
    {
        $this->expectException("GuzzleHttp\Exception\ClientException");
        $this->client->get('http://127.0.0.1:8000/address?district=bengaluru&state=kdjs123');
    }

    public function testInvalidDistrict()
    {
        $this->expectException("GuzzleHttp\Exception\ClientException");
        $this->client->get('http://127.0.0.1:8000/address?district=j23dh1&state=kdjs123');
    }

}
