<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\RFID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RFIDController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rfid = Data::get();
        return view('kartu-rfid.kelola-rfid', compact('rfid'));
    }
}
