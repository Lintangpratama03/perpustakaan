<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengarang extends Model
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
