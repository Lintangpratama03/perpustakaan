<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RFID extends Model
{
    use HasFactory;
    protected $table = "rfid";
    protected $fillable = [
        'id_kartu',
    ];
    public $timestamps = false;
}
