<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        return view('laravel-examples.user-profile', compact('user'));
    }

    public function update(Request $request)
    {
        if (config('app.is_demo') && in_array(Auth::id(), [1])) {
            return back()->with('error', "You are in a demo version. You are not allowed to change the email for default users.");
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            'username' => 'required|regex:/^[a-zA-Z0-9_]+$/|max:255|unique:users,username,' . Auth::id(),
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'alamat' => 'max:255',
            'hp' => 'numeric|digits:10',
            'nis' => 'max:255',
        ], [
            'name.required' => 'Name Harus Di Isi',
            'email.required' => 'Email Harus Di Isi',
            'username.required' => 'Username Harus Di Isi',
            'email.unique' => 'Email Sudah Dipakai.',
            'username.unique' => 'Username Sudah Dipakai',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::id());
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'nis' => $request->nis,
            'username' => $request->username,
        ]);

        return back()->with('success', 'Profile updated successfully.');
    }
}
