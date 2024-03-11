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
        $buku = Buku::select('buku.*', 'buku.name as name_buku', 'rak.kode as kode_rak')
            ->where('buku.is_deleted', 0)
            ->leftJoin('rak', 'buku.rak_kode_rak', '=', 'rak.id')
            ->leftJoin('penerbit', 'buku.penerbit_id', '=', 'penerbit.id')
            ->leftJoin('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->get();
        $pengarang = Pengarang::all();
        $penerbit = Penerbit::all();
        $rak = Rak::all();
        return view('buku.kelola-buku', compact('buku', 'pengarang', 'penerbit', 'rak'));
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

    // penerbit
    public function store_penerbit(Request $request)
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
            'alamat.required' => 'alamat penerbit harus diisi.',
            'alamat.max' => 'alamat penerbit tidak boleh lebih dari 255 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $penerbit = [
            'name' => $request->name,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ];

        penerbit::create($penerbit);

        return response()->json([
            'status' => 200,
        ]);
    }

    public function edit_penerbit($id)
    {
        $penerbit = penerbit::find($id);
        return response()->json([
            'id' => $penerbit->id,
            'name' => $penerbit->name,
            'alamat' => $penerbit->alamat,
            'telp' => $penerbit->telp,
        ]);
    }

    public function update_penerbit(Request $request, $id)
    {
        $penerbit = Penerbit::find($id);
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
        $penerbit->name = $request->input('name');
        $penerbit->alamat = $request->input('alamat');
        $penerbit->telp = $request->input('telp');

        // Simpan perubahan ke database
        $penerbit->save();

        return response()->json([
            'status' => 200,
        ]);
    }

    public function hapus_penerbit($id)
    {
        $penerbit = Penerbit::find($id);
        if (!$penerbit) {
            return response()->json([
                'status' => 404,
                'message' => 'penerbit not found.'
            ], 404);
        }

        $penerbit->is_deleted = 1;
        $penerbit->save();

        return response()->json([
            'status' => 200,
            'message' => 'penerbit ' . $penerbit->name . ' has been deleted.'
        ]);
    }

    public function store_buku(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'isbn' => 'required|string|max:255',
            'pengarang' => 'required|exists:pengarang,id',
            'penerbit' => 'required|exists:penerbit,id',
            'rak' => 'required|exists:rak,id',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'image.required' => 'Foto buku harus diunggah.',
            'image.image' => 'Foto harus berupa file gambar.',
            'image.mimes' => 'Format gambar yang diperbolehkan adalah: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',
            'isbn.required' => 'ISBN harus diisi.',
            'isbn.string' => 'ISBN harus berupa string.',
            'isbn.max' => 'ISBN tidak boleh lebih dari 255 karakter.',
            'pengarang.required' => 'Pengarang harus dipilih.',
            'pengarang.exists' => 'Pengarang yang dipilih tidak valid.',
            'penerbit.required' => 'Penerbit harus dipilih.',
            'penerbit.exists' => 'Penerbit yang dipilih tidak valid.',
            'rak.required' => 'Rak harus dipilih.',
            'rak.exists' => 'Rak yang dipilih tidak valid.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $imagePath = 'assets/img/buku/' . $fileName;
            $file->move(public_path('assets/img/buku'), $fileName);
        }

        $buku = [
            'name' => $request->name,
            'tahun_terbit' => $request->tahun_terbit,
            'jumlah' => $request->jumlah,
            'image' => $fileName,
            'isbn' => $request->isbn,
            'pengarang_id' => $request->pengarang,
            'penerbit_id' => $request->penerbit,
            'rak_kode_rak' => $request->rak,
        ];

        Buku::create($buku);

        return response()->json([
            'status' => 200,
        ]);
    }
    public function edit_buku($id)
    {
        $buku = Buku::find($id);
        // dd($buku);
        if (!$buku) {
            return response()->json(['message' => 'Buku not found'], 404);
        }
        $image = $buku->image ? asset('assets/img/buku/' . $buku->image) : asset('assets/img/default-image.png');
        return response()->json([
            'id' => $buku->id,
            'name' => $buku->name,
            'tahun_terbit' => $buku->tahun_terbit,
            'jumlah' => $buku->jumlah,
            'isbn' => $buku->isbn,
            'pengarang_id' => $buku->pengarang_id,
            'penerbit_id' => $buku->penerbit_id,
            'rak_kode_rak' => $buku->rak_kode_rak,
            'image' => $image
        ]);
    }



    public function update_buku(Request $request, $id)
    {
        $buku = Buku::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tahun_terbit' => 'required|numeric',
            'jumlah' => 'required|numeric',
            'isbn' => 'required|string|max:255',
            'pengarang' => 'required|exists:pengarang,id',
            'penerbit' => 'required|exists:penerbit,id',
            'rak' => 'required|exists:rak,id',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'name.required' => 'Nama harus diisi.',
            'name.string' => 'Nama harus berupa string.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.numeric' => 'Tahun terbit harus berupa angka.',
            'jumlah.required' => 'Jumlah harus diisi.',
            'jumlah.numeric' => 'Jumlah harus berupa angka.',
            'isbn.required' => 'ISBN harus diisi.',
            'isbn.string' => 'ISBN harus berupa string.',
            'isbn.max' => 'ISBN tidak boleh lebih dari 255 karakter.',
            'pengarang.required' => 'Pengarang harus dipilih.',
            'pengarang.exists' => 'Pengarang yang dipilih tidak valid.',
            'penerbit.required' => 'Penerbit harus dipilih.',
            'penerbit.exists' => 'Penerbit yang dipilih tidak valid.',
            'rak.required' => 'Rak harus dipilih.',
            'rak.exists' => 'Rak yang dipilih tidak valid.',
            'image.image' => 'File yang diunggah harus berupa gambar.',
            'image.mimes' => 'Format gambar yang diizinkan adalah jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar tidak boleh lebih dari 2048 KB.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $buku->name = $request->input('name');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->jumlah = $request->input('jumlah');
        $buku->isbn = $request->input('isbn');
        $buku->pengarang_id = $request->input('pengarang');
        $buku->penerbit_id = $request->input('penerbit');
        $buku->rak_kode_rak = $request->input('rak');

        // Jika ada file image baru, simpan ke penyimpanan dan update path gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/img/buku'), $fileName);
            if ($buku->image) {
                unlink(public_path('assets/img/buku/' . $buku->image));
            }
            $buku->image = $fileName;
        }
        // Simpan perubahan ke database
        $buku->save();

        // Beri respons bahwa perubahan berhasil
        return response()->json([
            'status' => 200,
        ]);
    }


    public function hapus_buku($id)
    {
        $buku = Buku::find($id);
        if (!$buku) {
            return response()->json([
                'status' => 404,
                'message' => 'Buku not found.'
            ], 404);
        }

        $buku->is_deleted = 1;
        $buku->save();

        return response()->json([
            'status' => 200,
            'message' => 'Buku ' . $buku->name . ' has been deleted.'
        ]);
    }
}
