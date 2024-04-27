<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PengajuanRfid extends Controller
{
    public function index()
    {
        $User = User::find(Auth::id());
        // dd($User);
        $id = $User->id;
        $users = User::where('is_deleted', 0)->where('id_posisi', 3)->where('id', $id)->get();
        // dd($users);
        return view('account-pages.pengajuan-rfid.pengajuan', compact('users'));
    }


    public function edit($id)
    {
        $anggota = User::find($id);
        $image = $anggota->image ? asset('../public_html/assets/img/foto-profil/' . $anggota->image) : asset('../public_html/assets/img/default-image.png');
        return response()->json([
            'id' => $anggota->id,
            'name' => $anggota->name,
            'email' => $anggota->email,
            'id_posisi' => $anggota->id_posisi,
            'nis' => $anggota->nis,
            'username' => $anggota->username,
            'hp' => $anggota->hp,
            'password' => $anggota->password,
            'alamat' => $anggota->alamat,
            'image' => $image
        ]);
    }

    public function update(Request $request, $id)
    {
        $anggota = User::find($id);
        // dd($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'password' => 'required|string|min:6',
            'nis' => 'required|numeric|unique:users,nis,' . $id,
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'hp' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            // Pesan error untuk setiap aturan validasi
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password harus diisi.',
            'password.string' => 'Password harus berupa string.',
            'password.min' => 'Password minimal 6 karakter.',
            'nis.required' => 'NIS harus diisi.',
            'nis.numeric' => 'NIS harus berupa angka.',
            'nis.unique' => 'NIS sudah digunakan.',
            'username.required' => 'Username harus diisi.',
            'username.string' => 'Username harus berupa string.',
            'username.max' => 'Username tidak boleh lebih dari 255 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'hp.required' => 'Nomor HP harus diisi.',
            'hp.string' => 'Nomor HP harus berupa string.',
            'hp.max' => 'Nomor HP tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa string.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'image.required' => 'Foto harus diisi.',
            'image.image' => 'File yang diupload harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2048 KB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simpan perubahan data dari request
        $anggota->name = $request->input('name');
        $anggota->email = $request->input('email');
        $anggota->permintaan = 1;
        $anggota->nis = $request->input('nis');
        $anggota->username = $request->input('username');
        $anggota->hp = $request->input('hp');
        $anggota->alamat = $request->input('alamat');


        // Jika ada perubahan password, hash password baru
        if ($request->has('password')) {
            $anggota->password = bcrypt($request->input('password'));
        }

        // Jika ada file image baru, simpan ke penyimpanan dan update path gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $publicHtmlPath = $_SERVER['DOCUMENT_ROOT'] . '/../public_html/assets/img/foto-profil/';
            $filePath = $publicHtmlPath . $fileName;
            $file->move($publicHtmlPath, $fileName);

            if ($anggota->image) {
                $oldImagePath = '../public_html/assets/img/foto-profil/' . $anggota->image;
                Storage::delete($oldImagePath);
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
}
