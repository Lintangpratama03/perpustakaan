<?php

namespace App\Http\Controllers;

use App\Models\kunjungan;
use Illuminate\Http\Request;

class PengunjungController extends Controller
{
    public function index()
    {
        $kunjungan = kunjungan::leftJoin('users', 'kunjungan.id_user', '=', 'users.id')->get();
        // dd($kunjungan);
        return view('kunjungan.index', compact('kunjungan'));
    }
}
