<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use App\Models\Tps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $data = Penduduk::all();
        $tps = Tps::all();
        return view("pages.dashboard", compact(['data', 'tps']));
    }
}
