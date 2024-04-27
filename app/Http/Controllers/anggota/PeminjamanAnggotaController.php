<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\buku;
use App\Models\keranjang;
use App\Models\peminjaman;
use App\Models\user;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_sukses()
    {
        $user = user::find(Auth::id());
        // dd($user);
        $id_card = $user->id_card;
        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('peminjaman.status', '>=', 3)
            ->where('peminjaman.id_card', $id_card)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
        return view('account-pages.peminjaman.sukses', compact('pinjam'));
    }

    public function index_ajuan()
    {
        $user = User::find(Auth::id());
        // dd($user);
        $id_card = $user->id_card;
        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('peminjaman.status', '<', 3)
            ->where('peminjaman.id_card', $id_card)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
        return view('account-pages.peminjaman.ajuan', compact('pinjam'));
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

    public function tolak($id)
    {
        $pinjam = peminjaman::find($id);
        if (!$pinjam) {
            return response()->json([
                'status' => 404,
                'message' => 'Peminjaman not found.'
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
            'message' => 'Berhasil Menolak Peminjaman'
        ]);
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
