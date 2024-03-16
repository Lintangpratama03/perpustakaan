<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userrfid = User::where('is_deleted', 0)->where('id_posisi', 2)
            ->get();
        // dd($userrfid);
        $swiperData = $this->getSwiperData($userrfid);
        return view('dashboard', compact('userrfid', 'swiperData'));
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
    public function getuser()
    {
    }
}
