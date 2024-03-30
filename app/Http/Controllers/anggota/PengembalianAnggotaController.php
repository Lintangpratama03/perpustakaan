<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Keranjang;
use App\Models\Peminjaman;
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
            $hari_terlambat = $hari_ini->diffInDays($tenggat_kembali, true);

            if ($hari_terlambat > 0) {
                $denda = $hari_terlambat * 5000;
                $item->denda = number_format($denda, 0, ',', '.');
            } else {
                $item->denda = 'Rp 0';
            }
        }
        return view('account-pages.pengembalian.belum', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
