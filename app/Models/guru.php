<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jabatan;

class guru extends Model
{
    /** @use HasFactory<\Database\Factories\GuruFactory> */
    use HasFactory;
    protected $table = 'guru';
    protected $guarded = [];
    protected $fillable = [
        'id_guru',
        'nama_guru',
        'jenis_kelamin',
        'no_telp',
        'alamat',
        'jabatan_id',
    ];

    public function setHonorPerjamAttribute($value)
    {
        $this->attributes['honor_perjam'] = str_replace('.', '', $value);
    }
    public function jabatan()
{
    return $this->belongsTo(Jabatan::class, 'jabatan_id');
}
    public function mengajar()
{
    return $this->hasMany(Mengajar::class, 'id_guru', 'id_guru');
}
    public function membina()
{
    return $this->hasMany(membina::class, 'id_guru', 'id_guru');
}
}