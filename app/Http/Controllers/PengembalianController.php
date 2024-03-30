<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianController extends Controller
{
    public function index()
    {
        $pinjam = Peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('status', 3)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        foreach ($pinjam as $item) {
            $tenggat_kembali = Carbon::parse($item->tenggat_kembali);
            $hari_ini = Carbon::now();
            $hari_terlambat = $hari_ini->diffInDays($tenggat_kembali, true);

            if ($hari_terlambat > 0) {
                $denda = $hari_terlambat * 5000;
                $item->denda = number_format($denda, 0, ',', '.');
            } else {
                $item->denda = 'Rp 0';
            }
        }
        // dd($pinjam);
        return view('pengembalian.belum', compact('pinjam'));
    }

    public function edit($id)
    {
        // dd($id);
        $buku = Keranjang::select('Keranjang.*', 'buku.name', 'buku.image')
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
        $pinjam = Peminjaman::find($id);
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ], 404);
        }
        //petugas
        $user = User::find(Auth::id());
        // dd($user);
        $id = $user->id;

        $pinjam->status = 2;
        $pinjam->petugas_id = $id;
        $pinjam->save();

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil Ganti Status'
        ]);
    }
}
