<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class BukuAnggotaController extends Controller
{
    public function index()
    {
        $buku = Buku::where('buku.is_deleted', 0)
            ->where('buku.jumlah', '>', 0)
            ->leftJoin('rak', 'buku.rak_kode_rak', '=', 'rak.id')
            ->leftJoin('penerbit', 'buku.penerbit_id', '=', 'penerbit.id')
            ->leftJoin('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->select('buku.*', 'rak.name as rak_name', 'rak.kode as rak_kode', 'pengarang.name as pengarang_name', 'penerbit.name as penerbit_name')
            ->get();
        $pengarangs = Pengarang::pluck('name', 'name');
        $penerbits = Penerbit::pluck('name', 'name');
        // dd($pengarangs);
        return view('account-pages.buku', compact('buku', 'pengarangs', 'penerbits'));
    }
}
