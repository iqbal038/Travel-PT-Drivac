<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supir extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'supir';
    protected $fillable = [
        'nama_supir', 'ttl_supir', 'no_tepon', 'jenis_kendaraan','norek','ontrip', 'id_user'
    ];
}
