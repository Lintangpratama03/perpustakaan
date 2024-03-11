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

    // Rak
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


    // Pengarang
    public function store_pengarang(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|max:255',
            'telp' => 'required|numeric',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'telp.required' => 'telp harus diisi.',
            'telp.numeric' => 'telp harus berupa Angka.',
            'alamat.required' => 'alamat rak harus diisi.',
            'alamat.max' => 'alamat rak tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $pengarang = [
            'name' => $request->name,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        Pengarang::create($pengarang);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit_pengarang($id)
    {
        $pengarang = Pengarang::find($id);
        return response()->json([
            'id' => $pengarang->id,
            'name' => $pengarang->name,
            'alamat' => $pengarang->alamat,
            'telp' => $pengarang->telp,
        ]);
    }

    public function update_pengarang(Request $request, $id)
    {
        $pengarang = Pengarang::find($id);
        // dd($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telp' => 'required|numeric',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'alamat.required' => 'Alamat harus diisi.',
            'alamat.string' => 'Alamat harus berupa string.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'telp.required' => 'telp harus diisi.',
            'telp.numeric' => 'telp harus berupa Angka.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Simpan perubahan data dari request
        $pengarang->name = $request->input('name');
        $pengarang->alamat = $request->input('alamat');
        $pengarang->telp = $request->input('telp');

        // Simpan perubahan ke database
        $pengarang->save();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function hapus_pengarang($id)
    {
        $pengarang = Pengarang::find($id);
        if (!$pengarang) {
            return response()->json([
                'status' => 404,
                'message' => 'pengarang not found.'
            ], 404);
        }

        $pengarang->is_deleted = 1;
        $pengarang->save();

        return response()->json([
            'status' => 200,
            'message' => 'pengarang ' . $pengarang->name . ' has been deleted.'
        ]);
    }
}
