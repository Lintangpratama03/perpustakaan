<?php

namespace App\Http\Controllers;

use App\Models\data;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\user;
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
        $users = user::where('is_deleted', 0)->where('id_posisi', 3)->where('permintaan', 1)->get();
        return view('user_permintaan.users-management', compact('users'));
    }

    public function edit($id)
    {
        $anggota = user::find($id);
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
        $anggota = user::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => 404,
                'message' => 'user not found.'
            ], 404);
        }

        $anggota->id_posisi = 2;
        $anggota->permintaan = 0;
        $anggota->save();

        return response()->json([
            'status' => 200,
            'message' => 'user ' . $anggota->name . ' has been upgrade.'
        ]);
    }

    // upgrade
    public function edit_scan($id)
    {
        $anggota = user::find($id);
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
        $existingUser = user::where('id_card', $id_card)->first();
        if ($existingUser) {
            return response()->json([
                'status' => 400,
                'message' => 'ID CARD telah terdaftar.'
            ]);
        }
        $user = user::where('id', $id)->first();
        if (!$user) {
            return response()->json([
                'status' => 404,
                'message' => 'user tidak ditemukan.'
            ]);
        }

        $user->id_posisi = 2;
        $user->id_card = $id_card;
        $user->permintaan = 0;
        $user->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil upgrade anggota.'
        ]);
    }
}
