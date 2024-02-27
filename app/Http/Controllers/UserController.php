<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function index()
    {
        $users = User::all();
        return view('pages.users.datausers', compact('users'));
    }

    // Show the form for creating a new user
    public function create()
    {
        return view('pages.users.tambahusers');
    }

    // Store a newly created user in the database
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users",
            "password" => "required|confirmed|min:8",
            "name" => "required|string",
            "level" => "required|numeric|min:0|max:1"
        ]);
        if ($validator->fails()) {
            return redirect('users')
                ->withErrors($validator)
                ->withInput();
        }
        User::create($request->all());

        return redirect()->route('users')->with('success', 'Berhasil Tambah User!');
    }

    // Show the form for editing the specified user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.users.editusers', compact('user'));
    }

    // Update the specified user in the database
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($user->id),
            ],
            "password" => "nullable|confirmed|min:8",
            "name" => "required|string",
            "level" => "required|numeric|min:0|max:1",
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        // Only update the password if it is provided
        if ($request->filled('password')) {
            $user->update(['password' => bcrypt($request->password)]);
        }

        // Update the other fields
        $user->update($request->only(['email', 'name', 'level']));

        return redirect()->route('users')->with('success', 'Berhasil Update User!');
    }

    // Remove the specified user from the database
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users')->with('success', 'Berhasil Hapus User!');
    }
}
