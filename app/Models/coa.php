<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coa extends Model
{
    /** @use HasFactory<\Database\Factories\CoaFactory> */
    use HasFactory;

    protected $fillable = [
        'kode_akun',
        'nama_akun',
        'header_akun',
    ];
    
    protected $table = 'coa';

    protected $guarded = [];

    public function getHeaderAkunTextAttribute()
    {
    return match ($this->header_akun){
        1 => 'Aset',
        2 => 'Kewajiban',
        3 => 'Ekuitas',
        4 => 'Pendapatan',
        5 => 'Beban',
        default => '-',};
    }
}