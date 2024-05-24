<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\keranjang;
use App\Models\peminjaman;
use App\Models\pengembalian;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengembalianAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $User = User::find(Auth::id());
        // dd($User);
        $id_card = $User->id_card;
        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where(function ($query) use ($id_card) {
                $query->where('peminjaman.status', 3)
                    ->orWhere('peminjaman.status', 4);
            })
            ->where('peminjaman.id_card', $id_card)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
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
        return view('account-pages.pengembalian.belum', compact('pinjam'));
    }

    public function edit($id)
    {
        $buku = keranjang::select('keranjang.*', 'buku.name', 'buku.image')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $data = [];
        // dd($buku);
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

    public function index_sukses()
    {
        $User = User::find(Auth::id());
        // dd($User);
        $id_card = $User->id_card;
        $pinjam = pengembalian::select('pengembalian.*', 'users.name as name_user', 'peminjaman.tanggal_pinjam')
            ->where('pengembalian.is_deleted', 0)
            ->where('pengembalian.status', 1)
            ->where('pengembalian.rfid', $id_card)
            ->leftJoin('users', 'pengembalian.rfid', '=', 'users.id_card')
            ->leftJoin('peminjaman', 'pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->get();
        // dd($pinjam);
        return view('account-pages.pengembalian.selesai', compact('pinjam'));
    }

    public function edit_sukses($id)
    {
        $buku = keranjang::select('keranjang.*', 'buku.name', 'buku.image')
            ->where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $data = [];
        // dd($buku);
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

    public function panjang($id)
    {
        $peminjaman = peminjaman::find($id);

        if ($peminjaman) {
            $peminjaman->status_perpanjang = 1;
            $peminjaman->save();

            return response()->json([
                'message' => 'Perpanjangan peminjaman berhasil diajukan.'
            ]);
        } else {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengajukan perpanjangan peminjaman.'
            ], 400);
        }
    }
}
