<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_pembelian_atk extends Model
{
    /** @use HasFactory<\Database\Factories\DetailPembelianAtkFactory> */
    use HasFactory;
    protected $table = 'detail_pembelian_atk';
    protected $fillable = [
        'pembelian_atk_id',
        'atk_id',
        'qty',
        'satuan',
        'harga',
        'subtotal',
    ];
    
    public function pembelianAtk()
    {
        return $this->belongsTo(PembelianAtk::class);
    }

    public function alatTulisKantor()
    {
        return $this->belongsTo(alat_tulis_kantor::class, 'atk_id');
    }
}
