<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DataApi extends Controller
{
    //
    public function getData()
    {
        return response(['message' => 'Ini adalah data dari API Laravel']);
    }
}
