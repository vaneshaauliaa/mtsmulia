<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pencatatan_kas extends Model
{
    use HasFactory;

    protected $table = 'pencatatan_kas';

    protected $fillable = [
        'tanggal',
        'jenis_transaksi',
        'sumber_dana_id',
        'jenis_pengeluaran_id',
        'jumlah',
        'keterangan',
        'bukti_transaksi',
    ];

    // RELASI KE SUMBER DANA (KAS MASUK)
    public function sumberDana()
    {
        return $this->belongsTo(sumber_dana::class, 'sumber_dana_id');
    }

    // RELASI KE JENIS PENGELUARAN (KAS KELUAR)
    public function jenisPengeluaran()
    {
        return $this->belongsTo(jenis_pengeluaran::class, 'jenis_pengeluaran_id');
    }
}
