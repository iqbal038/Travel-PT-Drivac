<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $primaryKey = 'id';
    protected $table = 'tujuan';
    protected $fillable = [
        'id','tujuan', 'harga',
    ];
}
