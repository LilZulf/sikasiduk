<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TpsController extends Controller
{
    //
    public function index(){
        return view("pages.tps.datatps");
    }
}
