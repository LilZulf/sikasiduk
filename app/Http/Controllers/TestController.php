<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    //
    public function index(){
        //$response = Http::timeout(5)->get('https://dayoffapi.vercel.app/api?year=2023');
        $ch = curl_init('http://localhost:8080/api/data');
        //$ch = curl_init('https://dayoffapi.vercel.app/api?year=2023');

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            // Handle cURL error
            echo 'Curl error: ' . curl_error($ch);
        }
        
        curl_close($ch);
        
        $data = json_decode($response, true);
        
        dd($data);
    }
}
