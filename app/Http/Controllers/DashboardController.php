<?php

namespace App\Http\Controllers;

use App\Models\kunjungan;
use App\Models\peminjaman;
use App\Models\user;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function storeKunjungan(Request $request)
    {
        $user = user::find(Auth::id());
        // dd($user);
        $id = $user->id;

        $today = Carbon::today();
        $existingKunjungan = kunjungan::where('id_user', $id)->whereDate('tanggal', $today)->first();

        if ($existingKunjungan) {
            return response()->json([
                'status' => 'warning',
                'message' => 'Anda sudah absen hari ini.'
            ]);
        }

        kunjungan::create([
            'tanggal' => $today,
            'id_user' => $id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Anda berhasil absen.'
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userrfid = user::where('is_deleted', 0)->where('id_posisi', 2)
            ->get();
        // dd($userrfid);
        $swiperData = $this->getSwiperData($userrfid);
        $pengunjung = kunjungan::count();
        $anggota = user::where('is_deleted', 0)->where('id_posisi', 3)->count();
        $anggota_rfid = user::where('is_deleted', 0)->where('id_posisi', 2)->count();
        $anggota_minta = user::where('is_deleted', 0)->where('id_posisi', 3)->where('permintaan', 1)->count();
        $hapus = user::where('is_deleted', 1)->count();

        $pinjam = peminjaman::select('peminjaman.*', 'users.name as name_user')
            ->where('peminjaman.is_deleted', 0)
            ->where('peminjaman.status', '>=', 3)
            ->leftJoin('users', 'peminjaman.id_card', '=', 'users.id_card')
            ->orderBy('peminjaman.created_at', 'desc')
            ->take(5)
            ->get();
        // dd($pengunjung);
        return view('dashboard', compact('userrfid', 'swiperData', 'hapus', 'pengunjung', 'anggota', 'anggota_rfid', 'anggota_minta', 'pinjam'));
    }
    public function index_anggota()
    {
        $userrfid = user::where('is_deleted', 0)->where('id_posisi', 2)
            ->get();
        // dd($userrfid);
        $swiperData = $this->getSwiperData($userrfid);
        $pengunjung = kunjungan::count();
        $anggota = user::where('is_deleted', 0)->where('id_posisi', 3)->count();
        $anggota_rfid = user::where('is_deleted', 0)->where('id_posisi', 2)->count();
        $anggota_minta = user::where('is_deleted', 0)->where('id_posisi', 3)->where('permintaan', 1)->count();
        $hapus = user::where('is_deleted', 1)->count();
        // dd($pengunjung);
        return view('account-pages/dashboard', compact('userrfid', 'swiperData', 'hapus', 'pengunjung', 'anggota', 'anggota_rfid', 'anggota_minta'));
    }

    public function getSwiperData($userrfid)
    {
        $swiperData = [];

        foreach ($userrfid as $user) {
            $swiperData[] = [
                'name' => $user->name,
                'nis' => $user->nis,
            ];
        }

        return $swiperData;
    }
    public function getPinjamData()
    {
        $peminjaman = peminjaman::selectRaw('COUNT(*) as total, MONTH(created_at) as month')
            ->where('is_deleted', 0)
            ->groupBy('month')
            ->get();

        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $data[$month] = 0;
        }

        foreach ($peminjaman as $item) {
            $data[$item->month] = $item->total;
        }

        $labels = array_map(function ($month) {
            return date('M', mktime(0, 0, 0, $month, 1));
        }, array_keys($data));

        return response()->json(['labels' => $labels, 'data' => array_values($data)]);
    }

    public function getKunjunganData()
    {
        $pengunjung = kunjungan::selectRaw('COUNT(*) as total, MONTH(tanggal) as month')
            ->groupBy('month')
            ->get();

        $data = [];
        for ($month = 1; $month <= 12; $month++) {
            $data[$month] = 0;
        }

        foreach ($pengunjung as $item) {
            $data[$item->month] = $item->total;
        }

        $labels = array_map(function ($month) {
            return date('M', mktime(0, 0, 0, $month, 1));
        }, array_keys($data));

        return response()->json(['labels' => $labels, 'data' => array_values($data)]);
    }
}
