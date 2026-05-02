<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perhitungan_gaji_guru extends Model
{
    use HasFactory;

    protected $table = 'perhitungan_gaji_guru';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'id_guru',
        'bulan',
        'tahun',
        'total_jam_mengajar',
        'honor_mengajar',
        'honor_ekstrakurikuler',
        'honor_jabatan',
        'total_gaji',
        'id_jenis_pengeluaran',
    ];

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru', 'id');
    }

    public function jenisPengeluaran()
    {
        return $this->belongsTo(jenis_pengeluaran::class, 'id_jenis_pengeluaran', 'id');
    }

    public function getBulanNamaAttribute()
    {
        $bulanNames = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulanNames[$this->bulan] ?? 'Unknown';
    }
}
