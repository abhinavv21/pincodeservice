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


    public function setUp()
    {
        $this->client = new Client();
    }

    public function tearDown()
    {


    }

    public function testNormalFlow()
    {

        $client = new CLient();
        $response = $client->get('http://127.0.0.1:8000/pincode/560040',
            [
                'form_params' =>
                    [
                    ]
            ]
        );

        $this->AssertEquals($response->getStatusCode(),200);
        $this->assertSame(json_encode([
            'taluk'          =>  ["Bangalore North"],
            'districtname'   =>  ["Bengaluru"],
            'statename'      =>  "karnataka",
            'statecode'      =>  "KA"
        ]), $response->getBody()->getContents());


    }

}
