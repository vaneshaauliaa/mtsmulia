<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ekstrakurikuler extends Model
{
    /** @use HasFactory<\Database\Factories\EkstrakurikulerFactory> */
    use HasFactory;
    protected $table = 'ekstrakurikuler';
    protected $guarded = [];
    protected $fillable = [
        'id_ekstrakurikuler',
        'nama_ekstrakurikuler',
    ];
}
