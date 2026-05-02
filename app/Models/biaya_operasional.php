<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class biaya_operasional extends Model
{
    use HasFactory;

    protected $table = 'biaya_operasional';
    protected $guarded = [];
    protected $fillable = [
        'tanggal',
        'kode_transaksi',
        'nomor_nota',
        'jenis_pengeluaran_id',
        'keterangan',
        'total',
        'bukti_transaksi',
    ];

    public function jenis_pengeluaran()
    {
        return $this->belongsTo(jenis_pengeluaran::class, 'jenis_pengeluaran_id', 'id');
    }
}
