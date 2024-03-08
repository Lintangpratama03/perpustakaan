<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_deleted', 0)->where('id_posisi', 3)->get();
        return view('laravel-examples.users-management', compact('users'));
    }

    public function store(Request $request)
    {
        $fileName = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/assets/img/foto-profil', $fileName);
        }

        $anggotaData = [
            'id_posisi' => $request->id_posisi,
            'nis' => $request->nis,
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'hp' => $request->hp,
            'alamat' => $request->alamat,
            'image' => $fileName,
        ];

        User::create($anggotaData);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit($id)
    {
        $anggota = User::find($id);
        $image = $anggota->image ? asset('storage/' . $anggota->image) : asset('assets/img/default-avatar.png');
        return response()->json([
            'id' => $anggota->id,
            'name' => $anggota->name,
            'email' => $anggota->email,
            'id_posisi' => $anggota->id_posisi,
            'nis' => $anggota->nis,
            'username' => $anggota->username,
            'hp' => $anggota->hp,
            'alamat' => $anggota->alamat,
            'image' => $image
        ]);
    }


    public function update(Request $request, $id)
    {
        $anggota = User::find($id);
        // dd($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        // Simpan perubahan data dari request
        $anggota->name = $request->input('name');
        $anggota->email = $request->input('email');
        $anggota->id_posisi = $request->input('id_posisi');
        $anggota->nis = $request->input('nis');
        $anggota->username = $request->input('username');
        $anggota->hp = $request->input('hp');
        $anggota->alamat = $request->input('alamat');


        // Jika ada perubahan password, hash password baru
        if ($request->has('password')) {
            $anggota->password = bcrypt($request->input('password'));
        }

        // Jika ada file avatar baru, simpan ke penyimpanan dan update path gambar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/assets/img/foto-profil', $fileName);
            if ($anggota->image) {
                Storage::delete('public/assets/img/foto-profil/' . $anggota->image);
            }
            $anggota->image = $fileName;
        }

        // Simpan perubahan ke database
        $anggota->save();

        // Beri respons bahwa perubahan berhasil
        return response()->json([
            'status' => 200,
        ]);
    }

    public function hapus($id)
    {
        $anggota = User::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ], 404);
        }

        $anggota->is_deleted = 1;
        $anggota->save();

        return response()->json([
            'status' => 200,
            'message' => 'User ' . $anggota->name . ' has been deleted.'
        ]);
    }
}
