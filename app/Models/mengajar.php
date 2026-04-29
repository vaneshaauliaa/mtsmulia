<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\guru;
use App\Models\mata_pelajaran;
use App\Models\kelas;

class mengajar extends Model
{
    /** @use HasFactory<\Database\Factories\MengajarFactory> */
    use HasFactory;
    protected $table = 'mengajar';
    protected $guarded = [];
    protected $fillable = ['id_guru', 'id_mata_pelajaran', 'id_kelas', 'jam_mengajar'];

    public function guru()
    {
        return $this->belongsTo(guru::class, 'id_guru', 'id_guru');
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo(mata_pelajaran::class, 'id_mata_pelajaran', 'id_mata_pelajaran');
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'id_kelas', 'id_kelas');
    }
}
