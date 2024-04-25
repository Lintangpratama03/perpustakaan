<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Data;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
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
            ->where(function ($query) {
                $query->where('status', 4)
                    ->orWhere('status', 3);
            })
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        foreach ($pinjam as $item) {
            $tenggat_kembali = Carbon::parse($item->tenggat_kembali);
            $hari_ini = Carbon::now();
            $hari_terlambat = $tenggat_kembali->diffInDays($hari_ini, false);
            // dd($hari_terlambat);
            if ($hari_terlambat > 0) {
                $denda = $hari_terlambat * 5000;
                $item->denda = 'Rp ' . number_format($denda, 0, ',', '.');
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
        $buku = Keranjang::select('keranjang.*', 'buku.name', 'buku.image', 'peminjaman.tenggat_kembali', 'peminjaman.id_card')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->leftJoin('peminjaman', 'keranjang.id_peminjaman', '=', 'peminjaman.id')
            ->get();

        $data = [];
        // dd($buku);
        foreach ($buku as $item) {
            $tenggat_kembali = Carbon::parse($item->tenggat_kembali);
            $hari_ini = Carbon::now();
            $hari_terlambat = $tenggat_kembali->diffInDays($hari_ini, false);
            // dd($hari_terlambat);
            if ($hari_terlambat > 0) {
                $denda = $hari_terlambat * 5000;
                $item->denda = 'Rp ' . number_format($denda, 0, ',', '.');
            } else {
                $item->denda = 'Rp 0';
            }
        }
        //dd($buku);
        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'denda' => $item->denda,
                'rfid' => $item->id_card,
                'telat' => $hari_terlambat,
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'image' => $image
            ];
        }
        // dd($data);
        return response()->json($data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_peminjaman' => 'required|integer',
        ]);
        $id_pinjam = $request->get('id_peminjaman');

        $pinjam = Peminjaman::find($id_pinjam);
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'Data peminjaman tidak ditemukan.'
            ], 404);
        }

        $user_id = Auth::id();

        $pinjam->status = 4;
        $pinjam->petugas_id = $user_id;
        $pinjam->save();

        $buku_keranjang = Keranjang::where('id_peminjaman', $id_pinjam)->get();

        foreach ($buku_keranjang as $item) {
            $buku = Buku::find($item->id_buku);
            if ($buku) {
                $buku->jumlah += $item->jumlah_pinjam;
                $buku->save();
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Status peminjaman berhasil diperbarui dan stok buku diperbarui.'
        ]);
    }


    public function edit_scan($id)
    {
        $buku = Keranjang::select('keranjang.*', 'buku.name', 'buku.image', 'peminjaman.tenggat_kembali')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->leftJoin('peminjaman', 'keranjang.id_peminjaman', '=', 'peminjaman.id')
            ->get();

        $scan = Data::select('data.value', 'users.name')
            ->leftJoin('users', 'data.value', '=', 'users.id_card')
            ->orderBy('data.created_at', 'desc')
            ->first();

        $data = [];
        foreach ($buku as $item) {
            $tenggat_kembali = Carbon::parse($item->tenggat_kembali);
            $hari_ini = Carbon::now();
            $hari_terlambat = $tenggat_kembali->diffInDays($hari_ini, false);
            // dd($hari_terlambat);
            if ($hari_terlambat > 0) {
                $denda = $hari_terlambat * 5000;
                $item->denda = $denda;
            } else {
                $item->denda = 0;
            }
        }
        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'denda' => $item->denda,
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

    public function scan($id, $id_card, $denda)
    {
        $pinjam = Peminjaman::where('id', $id)
            ->where('id_card', $id_card)
            ->where('status', 4)
            ->first();

        // Periksa apakah peminjaman ditemukan
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'Peminjaman tidak ditemukan.'
            ], 404);
        }

        $hari_terlambat = 0;

        // Jika peminjaman ditemukan, hitung hari terlambat
        $tenggat_kembali = Carbon::parse($pinjam->tenggat_kembali);
        $hari_ini = Carbon::now();
        $hari_terlambat = $tenggat_kembali->diffInDays($hari_ini, false);

        $pinjam->status = 5;
        $pinjam->tanggal_kembali = $hari_ini;
        $pinjam->save();
        if ($hari_terlambat < 0) {
            $hari_terlambat = "0";
        }
        $kembali = [
            'tanggal_pengembalian' => $hari_ini,
            'denda' => $denda,
            'telat' => $hari_terlambat,
            'peminjaman_id' => $id,
            'rfid' => $id_card,
            'petugas_id' => $id,
            'status' => 1
        ];
        // dd($kembali);
        Pengembalian::create($kembali);

        return response()->json([
            'status' => 200,
            'message' => 'Berhasil mengubah status peminjaman.'
        ]);
    }


    // sukses
    public function index_sukses()
    {
        $pinjam = Pengembalian::select('Pengembalian.*', 'users.name as name_user', 'peminjaman.tanggal_pinjam')
            ->where('Pengembalian.is_deleted', 0)
            ->where('Pengembalian.status', 1)
            ->leftJoin('users', 'Pengembalian.rfid', '=', 'users.id_card')
            ->leftJoin('peminjaman', 'Pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->get();
        // dd($pinjam);
        return view('pengembalian.selesai', compact('pinjam'));
    }

    public function edit_sukses($id)
    {
        // dd($id);
        $buku = Keranjang::select('keranjang.*', 'buku.name', 'buku.image', 'peminjaman.tenggat_kembali', 'peminjaman.id_card', 'pengembalian.denda', 'pengembalian.telat')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->leftJoin('peminjaman', 'keranjang.id_peminjaman', '=', 'peminjaman.id')
            ->leftJoin('pengembalian', 'peminjaman.id', '=', 'pengembalian.peminjaman_id')
            ->get();

        $data = [];
        // dd($buku);
        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'id_peminjaman' => $item->id_peminjaman,
                'name' => $item->name,
                'denda' => $item->denda,
                'rfid' => $item->id_card,
                'telat' => $item->telat,
                'jumlah_pinjam' => $item->jumlah_pinjam,
                'image' => $image
            ];
        }
        // dd($data);
        return response()->json($data);
    }
}
