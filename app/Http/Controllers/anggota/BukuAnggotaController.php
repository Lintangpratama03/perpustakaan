<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Keranjang;
use App\Models\Peminjaman;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\Rak;
use Exception;
use Illuminate\Http\Request;

class BukuAnggotaController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->input('name');
        $pengarangId = $request->input('pengarang');
        $penerbitId = $request->input('penerbit');
        $rakId = $request->input('rak');

        $buku = Buku::where('buku.is_deleted', 0)
            ->where('buku.jumlah', '>', 0)
            ->leftJoin('rak', 'buku.rak_kode_rak', '=', 'rak.id')
            ->leftJoin('penerbit', 'buku.penerbit_id', '=', 'penerbit.id')
            ->leftJoin('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->select('buku.*', 'rak.name as rak_name', 'rak.kode as rak_kode', 'pengarang.name as pengarang_name', 'penerbit.name as penerbit_name')
            ->when($name, function ($query, $name) {
                return $query->where('buku.name', 'like', '%' . $name . '%');
            })
            ->when($pengarangId, function ($query, $pengarangId) {
                return $query->where('buku.pengarang_id', $pengarangId);
            })
            ->when($penerbitId, function ($query, $penerbitId) {
                return $query->where('buku.penerbit_id', $penerbitId);
            })
            ->when($rakId, function ($query, $rakId) {
                return $query->where('buku.rak_kode_rak', $rakId);
            })
            ->get();

        $pengarangs = Pengarang::pluck('name', 'id');
        $penerbits = Penerbit::pluck('name', 'id');
        $rak = Rak::pluck('name', 'id');

        return view('account-pages.buku', compact('buku', 'pengarangs', 'penerbits', 'rak'));
    }

    public function bookCart()
    {
        return view('account-pages.cart');
    }

    public function addBooktoCart($id)
    {
        $book = Buku::findOrFail($id);
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            $cart[$id] = [
                "id" => $book->id,
                "name" => $book->name,
                "jumlah" => 1,
                "tahun_terbit" => $book->tahun_terbit,
                "image" => $book->image
            ];
        }
        // dd($cart);
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Buku Berhasil tambah ke Cart!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->jumlah) {
            $cart = session()->get('cart');
            $cart[$request->id]["jumlah"] = $request->jumlah;
            session()->put('cart', $cart);
            session()->flash('success', 'Book added to cart.');
        }
    }

    public function deleteProduct(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Book successfully deleted.');
        }
    }


    public function checkout(Request $request)
    {
        $tanggalPinjam = now();
        $tenggatKembali = now()->addDays(7);
        try {
            $peminjaman = new Peminjaman;
            $peminjaman->tanggal_pinjam = $tanggalPinjam;
            $peminjaman->tenggat_kembali = $tenggatKembali;
            $peminjaman->status = 1;
            $peminjaman->save();

            $ids = $request->input('ids');
            $quantities = $request->input('quantities');
            foreach ($ids as $key => $id_buku) {
                $keranjang = new Keranjang;
                $keranjang->id_peminjaman = $peminjaman->id;
                $keranjang->id_buku = $id_buku;
                $keranjang->jumlah_pinjam = $quantities[$key];
                $keranjang->save();

                $buku = Buku::find($id_buku);
                if ($buku) {
                    $buku->jumlah -= $quantities[$key];
                    $buku->save();
                }
            }

            session()->forget('cart');

            return response()->json(['message' => 'Checkout berhasil'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
        }
    }
}
