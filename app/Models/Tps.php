<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    use HasFactory;
    protected $primaryKey = "tps";
    public $incrementing = false;
    protected $fillable = [
        "tps",
        "nama_tps",
        "alamat",
        "rt",
        "rw",
        "foto",
        "long",
        "lat",
        "uid",
        "status",
        "id_alamat",
    ];
    protected $table = 'tps';

}
