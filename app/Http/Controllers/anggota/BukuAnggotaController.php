<?php

namespace App\Http\Controllers\anggota;

use App\Http\Controllers\Controller;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Pengarang;
use Illuminate\Http\Request;

class BukuAnggotaController extends Controller
{
    public function index()
    {
        $buku = Buku::where('buku.is_deleted', 0)
            ->where('buku.jumlah', '>', 0)
            ->leftJoin('rak', 'buku.rak_kode_rak', '=', 'rak.id')
            ->leftJoin('penerbit', 'buku.penerbit_id', '=', 'penerbit.id')
            ->leftJoin('pengarang', 'buku.pengarang_id', '=', 'pengarang.id')
            ->select('buku.*', 'rak.name as rak_name', 'rak.kode as rak_kode', 'pengarang.name as pengarang_name', 'penerbit.name as penerbit_name')
            ->get();
        $pengarangs = Pengarang::pluck('name', 'name');
        $penerbits = Penerbit::pluck('name', 'name');
        // dd($pengarangs);
        $cartItems = [];
        return view('account-pages.buku', compact('buku', 'pengarangs', 'penerbits', 'cartItems'));
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
                "name" => $book->name,
                "jumlah" => 1,
                "tahun_terbit" => $book->tahun_terbit,
                "image" => $book->image
            ];
        }
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
}
