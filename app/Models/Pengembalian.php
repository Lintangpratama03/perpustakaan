<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;
    protected $table = "pengembalian";
    protected $fillable = [
        'tanggal_pengembalian',
        'denda',
        'peminjaman_id',
        'petugas_id',
        'rfid',
        'status',
    ];
    public $timestamps = false;
}
