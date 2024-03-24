<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pinjam = Peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('status', '!=', 3)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->get();
        // dd($pinjam);
        return view('peminjaman.ajuan', compact('pinjam'));
    }

    public function edit($id)
    {
        $buku = Keranjang::where('id_peminjaman', $id)
            ->leftJoin('buku', 'keranjang.id_buku', '=', 'buku.id')
            ->get();

        $data = [];

        foreach ($buku as $item) {
            $image = $item->image ? asset('assets/img/buku/' . $item->image) : asset('assets/img/default-image.png');
            $data[] = [
                'id' => $item->id,
                'name' => $item->name,
                'image' => $image
            ];
        }
        // dd($data);
        return response()->json($data);
    }


    public function hapus($id)
    {
        $anggota = Keranjang::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => 404,
                'message' => 'User not found.'
            ], 404);
        }

        $anggota->is_deleted = 1;
        $anggota->save();

        return response()->json([
            'status' => 200,
            'message' => 'User ' . $anggota->name . ' has been deleted.'
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
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
