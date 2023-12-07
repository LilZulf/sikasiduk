<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory;
    protected $table = 'testings';

    protected $fillable = [
        'id_proses',
        'id_penduduk',
        'prediksi'
    ];
}
