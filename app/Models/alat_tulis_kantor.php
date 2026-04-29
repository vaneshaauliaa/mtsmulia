<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alat_tulis_kantor extends Model
{
    /** @use HasFactory<\Database\Factories\AlatTulisKantorFactory> */
    use HasFactory;
    protected $table = 'alat_tulis_kantor';
    protected $guarded = [];
    protected $fillable = [
        'kode_atk',
        'nama_atk',
    ];

    public function detailPembelianAtk()
    {
        return $this->hasMany(detail_pembelian_atk::class, 'atk_id');
    }
}
