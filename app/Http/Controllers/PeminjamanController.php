<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\data;
use App\Models\keranjang;
use App\Models\peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where(function ($query) {
                $query->where('status', 1)
                    ->orWhere('status', 2);
            })
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
        return view('peminjaman.ajuan', compact('pinjam'));
    }

    public function edit($id)
    {
        // dd($id);
        $buku = keranjang::select('keranjang.*', 'buku.name', 'buku.image')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $data = [];
        //dd($buku);
        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'image' => $image
            ];
        }
        // dd($data);
        return response()->json($data);
    }

    public function update($id)
    {
        $pinjam = peminjaman::find($id);
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ], 404);
        }
        //petugas
        $User = User::find(Auth::id());
        // dd($User);
        $id = $User->id;

        $pinjam->status = 2;
        $pinjam->petugas_id = $id;
        $pinjam->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Ganti Status'
        ]);
    }

    public function tolak($id)
    {
        $pinjam = peminjaman::find($id);
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'peminjaman not found.'
            ], 404);
        }
        $pinjam->is_deleted = 1;
        $id_peminjaman = $pinjam->id;
        keranjang::where('id_peminjaman', $id_peminjaman)->update(['is_deleted' => 1]);
        $keranjang = keranjang::where('id_peminjaman', $id_peminjaman)->get();
        foreach ($keranjang as $item) {
            $buku = buku::find($item->id_buku);
            if ($buku) {
                $buku->jumlah += $item->jumlah_pinjam;
                $buku->save();
            }
        }
        $pinjam->save();
        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Menolak peminjaman'
        ]);
    }

    public function edit_scan($id)
    {
        $buku = keranjang::select('keranjang.*', 'buku.name', 'buku.image')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $scan = data::select('data.value', 'users.name')
            ->leftJoin('users', 'data.value', '=', 'users.id_card')
            ->orderBy('data.created_at', 'desc')
            ->first();

        $data = [];

        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'image' => $image
            ];
        }

        if ($scan) {
            $data[] = [
                'scan' => $scan->value,
                'name' => $scan->name
            ];
        }
        // dd($data);
        return response()->json($data);
    }


    public function scan($id, $id_card)
    {
        // Menggunakan first() untuk mendapatkan hasil pertama atau null jika tidak ditemukan
        $pinjam = peminjaman::where('id', $id)
            ->where('id_card', $id_card)
            ->where('status', 2)
            ->first();
        $tanggal = now();
        $tenggatKembali = now()->addDays(7);
        // Periksa apakah peminjaman ditemukan
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'peminjaman tidak ditemukan.'
            ], 404);
        }

        // Ubah status peminjaman menjadi 3
        $pinjam->status = 3;
        $pinjam->tanggal_pinjam = $tanggal;
        $pinjam->tenggat_kembali = $tenggatKembali;
        $pinjam->status = 3;

        $pinjam->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengubah status peminjaman.'
        ]);
    }

    // sukses
    public function index_sukses()
    {
        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('peminjaman.status', '>=', 3)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
        return view('peminjaman.sukses', compact('pinjam'));
    }

    public function edit_sukses($id)
    {
        // dd($id);
        $buku = keranjang::select('keranjang.*', 'buku.name', 'buku.image')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $data = [];
        //dd($buku);
        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'image' => $image
            ];
        }
        // dd($data);
        return response()->json($data);
    }
}
