<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\Response;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view("pages.register");
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users",
            "password" => "required|confirmed|min:8",
            "nama" => "required|string"
        ]);
        if ($validator->fails()) {
            return redirect('register')
                ->withErrors($validator)
                ->withInput();
        }
        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 0,
        ]);
        if ($user) {
            return redirect('login');
        }
        return redirect('register')->withErrors(['Error' => 'Something When Wrong!']);
    }
}
