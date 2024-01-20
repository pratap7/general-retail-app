<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class TestController extends Controller {

    public function sendSMS(){

        $API_KEY = config('global.SMS_CONFIG.API_KEY');
        $MESSAGE = "Hi, How are you";
        $MOBILE_NO = "+91" . "7696357032";
        $data = array(
            'message'      => $MESSAGE,
            'to'           => $MOBILE_NO,
            'sender_id'    => "SHYAMCORP",
            'callback_url' => "https://example.com/callback/handler"
        );
        $data = json_encode($data);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.sms.to/sms/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>$data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Accept: application/json",
            "Authorization: Bearer {$API_KEY}"
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        dd($response);
    }
}