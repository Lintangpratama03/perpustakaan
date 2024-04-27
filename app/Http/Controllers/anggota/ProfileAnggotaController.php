<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileAnggotaController extends Controller
{
    public function index_anggota()
    {
        $User = User::find(Auth::id());
        return view('account-pages.user-profile', compact('User'));
    }

    public function update_anggota(Request $request)
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
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image file
        ], [
            'name.required' => 'Name Harus Di Isi',
            'email.required' => 'Email Harus Di Isi',
            'username.required' => 'Username Harus Di Isi',
            'email.unique' => 'Email Sudah Dipakai.',
            'username.unique' => 'Username Sudah Dipakai',
            'image.image' => 'File harus berupa gambar',
            'image.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, atau gif',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $User = User::find(Auth::id());
        $User->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'hp' => $request->hp,
            'nis' => $request->nis,
            'username' => $request->username,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $publicHtmlPath = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/foto-profil/';
            $imagePath = $publicHtmlPath . $imageName;
            $image->move($publicHtmlPath, $imageName);

            if ($User->image) {
                $oldImagePath = $publicHtmlPath . $User->image;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $User->image = $imageName;
        }

        $User->save();

        return back()->with('success', 'Profile updated successfully.');
    }
}
