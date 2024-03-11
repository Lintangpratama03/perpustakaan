<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    use HasFactory;
    protected $table = "pengarang";
    protected $fillable = [
        'name',
        'alamat',
        'telp',
    ];
    public $timestamps = false;
}
