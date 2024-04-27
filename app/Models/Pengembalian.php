<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengembalian extends Model
{
    use HasFactory;
    protected $table = "pengembalian";
    protected $fillable = [
        'tanggal_pengembalian',
        'denda',
        'telat',
        'peminjaman_id',
        'petugas_id',
        'rfid',
        'status',
    ];
    public $timestamps = false;
}
