<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jabatan extends Model
{
    /** @use HasFactory<\Database\Factories\JabatanFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $table = 'jabatan';
    
    protected $fillable = [
        'nama_jabatan',
        'honor_jabatan',
    ];

    public function setHonorJabatanAttribute($value)
    {
        $this->attributes['honor_jabatan'] = str_replace('.', '', $value);
    }

    public function guru()
    {
        return $this->hasMany(Guru::class);
    }
}
