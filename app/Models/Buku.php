<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = "buku";
    protected $fillable = [
        'name',
        'alamat',
        'telp',
        'tahun_terbit',
        'jumlah',
        'image',
        'isbn',
        'pengarang_id',
        'penerbit_id',
        'rak_kode_rak',
    ]; //    
    public $timestamps = false;
}
