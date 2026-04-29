<?php

namespace App\Models;

use App\Models\pemasukan_dana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class sumber_dana extends Model
{
    /** @use HasFactory<\Database\Factories\SumberDanaFactory> */
    use HasFactory;

    protected $table = 'sumber_dana';
    protected $guarded = [];
    protected $fillable = [
        'id_sumber_dana',
        'nama_sumber_dana',
    ];

    public function pemasukanDana()
    {
    return $this->hasMany(pemasukanDana::class);
    }
}
