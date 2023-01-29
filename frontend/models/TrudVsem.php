<?php

namespace app\models;

use Yii;


class TrudVsem
{

    private static $headers = array(
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.0.0 Safari/537.36"
    );

    private static $filter = array(
        "regionCode"=>["0200000000000"],//, "7700000000000", "5000000000000"
        "education"=>["MIDDLE_SPECIAL","HIGH"],
        "releaseDate"=>[1662922800000,1666465200000],
        "publishDateTime"=>["EXP_MAX"]
    );

    public function __construct($settings, $regions = null){

        self::$filter["regionCode"] = $regions;
        self::$filter["releaseDate"][0] = $settings->readyFrom;
        self::$filter["releaseDate"][1] = $settings->readyTo;

        self::$headers[] = "Cookie: ".$settings->cookie;

    }



    public function getResume(){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://trudvsem.ru/iblocks/_catalog/flat_filter_prr_search_cv/data',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => array(
                "filter" => json_encode(self::$filter),
                "orderColumn" => "RELEVANCE_DESC",
                "pageSize"=>2000),
            CURLOPT_HTTPHEADER => self::$headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
//
        return json_decode($response)->result->data;

    }


    public function getCandidate($id, $id2){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://trudvsem.ru/iblocks/prr_cv_viewing/$id2/$id",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => self::$headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response)->data;

    }

    public function getContact($id, $id2){

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://trudvsem.ru/iblocks/flat_filter_prr_search_cv/candidates/$id2/cvs/$id/contactsData",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => self::$headers,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response);

    }
}
