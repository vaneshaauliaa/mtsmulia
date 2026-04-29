<?php

namespace App\Models;

use App\Models\sumber_dana;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan_dana extends Model
{
    /** @use HasFactory<\Database\Factories\PemasukanDanaFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'pemasukan_dana';

    protected $fillable = [
        'tanggal',
        'kode_transaksi',
        'sumber_dana_id',
        'jumlah',
        'keterangan',
        'bukti_transaksi',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public function sumberDana()
    {
    return $this->belongsTo(sumber_dana::class);
    }
}
