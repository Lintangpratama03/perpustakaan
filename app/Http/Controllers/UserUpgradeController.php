<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserUpgradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('is_deleted', 0)->where('id_posisi', 3)->where('permintaan', 1)->get();
        return view('user_permintaan.users-management', compact('users'));
    }

    public function edit($id)
    {
        $anggota = User::find($id);
        $image = $anggota->image ? asset('assets/img/foto-profil/' . $anggota->image) : asset('assets/img/default-image.png');
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

    public function hapus($id)
    {
        $anggota = User::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ], 404);
        }

        $anggota->id_posisi = 2;
        $anggota->permintaan = 0;
        $anggota->save();

        return response()->json([
            'status' => 200,
            'message' => 'User ' . $anggota->name . ' has been upgrade.'
        ]);
    }

    // upgrade
    public function edit_scan($id)
    {
        $anggota = User::find($id);
        // dd($anggota);
        $scan = data::select('value')
            ->orderBy('created_at', 'desc')
            ->first();

        if ($scan) {
            $data = [
                'scan' => $scan->value,
                'name' => $anggota->name
            ];
        } else {
            $data = [];
        }

        return response()->json($data);
    }


    public function scan($id, $id_card)
    {
        $existingUser = User::where('id_card', $id_card)->first();
        if ($existingUser) {
            return response()->json([
                'status' => 400,
                'message' => 'ID CARD telah terdaftar.'
            ]);
        }
        $User = User::where('id', $id)->first();
        if (!$User) {
            return response()->json([
                'status' => 404,
                'message' => 'User tidak ditemukan.'
            ]);
        }

        $User->id_posisi = 2;
        $User->id_card = $id_card;
        $User->permintaan = 0;
        $User->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil upgrade anggota.'
        ]);
    }
}
