<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        $kunjungan = Kunjungan::leftJoin('users', 'kunjungan.id_user', '=', 'users.id')->get();
        // dd($kunjungan);
        return view('kunjungan.index', compact('kunjungan'));
    }
}
