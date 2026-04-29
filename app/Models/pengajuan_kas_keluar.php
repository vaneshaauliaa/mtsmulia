<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengajuan_kas_keluar extends Model
{
    /** @use HasFactory<\Database\Factories\PengajuanKasKeluarFactory> */
    use HasFactory;
    protected $table = 'pengajuan_kas_keluar';
    protected $guarded = [];
    protected $fillable = [
        'tanggal_pengajuan',
        'jenis_pengeluaran_id',
        'jumlah_pengajuan',
        'keterangan',
        'status',
        'berkas_pengajuan',
    ];

    public function jenis_pengeluaran()
    {
        return $this->belongsTo(jenis_pengeluaran::class, 'jenis_pengeluaran_id', 'id');
    }
}

