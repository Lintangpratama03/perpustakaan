<?php

namespace App\Http\Controllers;

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
        $rfid = RFID::where('rfid.is_deleted', 0)
            ->get();
        return view('kartu-rfid.kelola-rfid', compact('rfid'));
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
        $validator = Validator::make($request->all(), [
            'id_kartu' => 'required|unique:rfid,id_kartu',
        ], [
            'id_kartu.required' => 'Kode RFID harus diisi.',
            'id_kartu.unique' => 'Kode RFID sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $rfid = [
            'id_kartu' => $request->id_kartu,
        ];

        RFID::create($rfid);

        return response()->json([
            'status' => 'success',
            'message' => 'Data RFID berhasil disimpan.',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RFID $rFID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RFID $rFID)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RFID $rFID)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RFID $rFID)
    {
        //
    }
}
