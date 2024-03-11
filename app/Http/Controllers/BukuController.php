<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::where('buku.is_deleted', 0)
            ->leftJoin('rak', 'buku.rak_kode_rak', '=', 'rak.kode_rak')
            ->leftJoin('penerbit', 'buku.id_card', '=', 'penerbit.id')
            ->leftJoin('pengarang', 'buku.id_card', '=', 'pengarang.id')
            ->get();
        return view('buku.kelola-buku', compact('buku'));
    }
    public function index_rak()
    {
        $rak = Rak::where('rak.is_deleted', 0)
            ->get();
        return view('buku.kelola-rak', compact('rak'));
    }
    public function index_penerbit()
    {
        $penerbit = Penerbit::where('penerbit.is_deleted', 0)
            ->get();
        return view('buku.kelola-penerbit', compact('penerbit'));
    }
    public function index_pengarang()
    {
        $pengarang = Pengarang::where('pengarang.is_deleted', 0)
            ->get();
        return view('buku.kelola-pengarang', compact('pengarang'));
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
    public function store_rak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'kode' => 'required|max:3|unique:rak',
            'lokasi' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'lokasi.string' => 'Lokasi harus berupa string.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
            'kode.required' => 'kode rak harus diisi.',
            'kode.max' => 'kode rak tidak boleh lebih dari 255 karakter.',
            'kode.unique' => 'kode rak sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $rak = [
            'name' => $request->name,
            'kode' => $request->kode,
            'lokasi' => $request->lokasi,
        ];

        Rak::create($rak);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit_rak($id)
    {
        $rak = Rak::find($id);
        return response()->json([
            'id' => $rak->id,
            'name' => $rak->name,
            'kode' => $rak->kode,
            'lokasi' => $rak->lokasi,
        ]);
    }

    public function update_rak(Request $request, $id)
    {
        $rak = Rak::find($id);
        // dd($id);
        $validator = Validator::make($request->all(), [
            'kode' => 'required|max:3|unique:rak,kode,' . $id,
            'name' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'lokasi.string' => 'Lokasi harus berupa string.',
            'lokasi.max' => 'Lokasi tidak boleh lebih dari 255 karakter.',
            'kode.required' => 'kode rak harus diisi.',
            'kode.max' => 'kode rak tidak boleh lebih dari 255 karakter.',
            'kode.unique' => 'kode rak sudah digunakan.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simpan perubahan data dari request
        $rak->name = $request->input('name');
        $rak->kode = $request->input('kode');
        $rak->lokasi = $request->input('lokasi');

        // Simpan perubahan ke database
        $rak->save();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function hapus_rak($id)
    {
        $rak = Rak::find($id);
        if (!$rak) {
            return response()->json([
                'status' => 404,
                'message' => 'Rak not found.'
            ], 404);
        }

        $rak->is_deleted = 1;
        $rak->save();

        return response()->json([
            'status' => 200,
            'message' => 'Rak ' . $rak->name . ' has been deleted.'
        ]);
    }
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
    }
}
