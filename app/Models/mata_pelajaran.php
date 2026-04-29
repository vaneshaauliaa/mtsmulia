<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mata_pelajaran extends Model
{
    /** @use HasFactory<\Database\Factories\MataPelajaranFactory> */
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $guarded = [];
    protected $fillable = [
        'id_mata_pelajaran',
        'nama_mata_pelajaran',
    ];
    
}
