<?php

namespace App\Tasks;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use DB;
use App\Models\Pinupdates;


/**
 *  Cron job to sync the local database with api
 *
 */

class PincodeCron
{

    const URL = "https://api.data.gov.in/resource/6176ee09-3d56-4a3b-8115-21841576b2f6";
    const API_KEY = "579b464db66ec23bdd000001467eacff298e4129649cb94dbe01bcdf";
    const FORMAT = "json";


    public static function SyncDatabase()
    {
        $client = new Client();
        //$lastCreatedList = new Pinupdates();
        //$tableCreatedAt = $lastCreatedList->getter();
        self::dropOldTable();
        self::createNewTable();

        $offset = 1000;

        for ($i = 0; ; $i = $i + $offset)
        {
            $response = $client->get(self::buildUrl($i,1000),
                [
                    'form_params' =>
                        [
                        ]
                ]
            );

            if( $response->getStatusCode() === 200)
            {
                $response_body = json_decode($response->getBody()->getContents(), true);

                $count = $response_body['count'];
                $records_list = $response_body['records'];
                if ($count === 0) {
                    break;
                }

                self::insertIntoTable($records_list);
            }

        }

    }


    private static function buildUrl($offset,$limit)
    {
        return self::URL."?api-key=".self::API_KEY."&format=".self::FORMAT."&offset=$offset&limit=$limit";
    }

    private static function dropOldTable()
    {
        Schema::dropIfExists('pincode');
    }

    private static function createNewTable()
    {
        Schema::create('pincode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('officename');
            $table->integer('pincode');
            $table->string('officetype');
            $table->string('deliverystatus');
            $table->string('divisionname');
            $table->string('regionname');
            $table->string('circlename');
            $table->string('taluk');
            $table->string('districtname');
            $table->string('statename');
            $table->timestamps();
        });
    }

    private static function insertIntoTable($records_list)
    {
        DB::table('pincode')->insert($records_list);
    }

}