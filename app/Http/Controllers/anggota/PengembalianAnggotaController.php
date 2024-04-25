<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
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
        $user = User::find(Auth::id());
        // dd($user);
        $id_card = $user->id_card;
        $pinjam = Peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('peminjaman.status', 3)
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
        $buku = Keranjang::select('Keranjang.*', 'buku.name', 'buku.image')
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
        $user = User::find(Auth::id());
        // dd($user);
        $id_card = $user->id_card;
        $pinjam = Pengembalian::select('Pengembalian.*', 'users.name as name_user', 'peminjaman.tanggal_pinjam')
            ->where('Pengembalian.is_deleted', 0)
            ->where('Pengembalian.status', 1)
            ->where('Pengembalian.rfid', $id_card)
            ->leftJoin('users', 'Pengembalian.rfid', '=', 'users.id_card')
            ->leftJoin('peminjaman', 'Pengembalian.peminjaman_id', '=', 'peminjaman.id')
            ->get();
        // dd($pinjam);
        return view('account-pages.pengembalian.selesai', compact('pinjam'));
    }

    public function edit_sukses($id)
    {
        $buku = Keranjang::select('Keranjang.*', 'buku.name', 'buku.image')
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
}
