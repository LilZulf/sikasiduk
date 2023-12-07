<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    use HasFactory;
    protected $table = 'proses';

    protected $fillable = [
        'nilai_k',
        'uid',
        'file',
        'status'
    ];
}
