<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\guru;
use App\Models\ekstrakurikuler;

class membina extends Model
{
    /** @use HasFactory<\Database\Factories\MembinaFactory> */
    use HasFactory;

    protected $table = 'membina';

    protected $guarded = [];

    protected $fillable = [
        'id_guru',
        'id_ekstrakurikuler',
    ];

    public function guru()
    {
        return $this->belongsTo(
            guru::class,
            'id_guru',
            'id_guru'
        );
    }
    public function ekstrakurikuler()
    {
        return $this->belongsTo(
            ekstrakurikuler::class,
            'id_ekstrakurikuler',
            'id_ekstrakurikuler'
        );
    }
    
}
