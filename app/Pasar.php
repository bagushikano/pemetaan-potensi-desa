<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasar extends Model
{
    protected $table = 'tb_pasar';

    protected $fillable = [
        'id_desa',
        'id_jenis_potensi',
        'nama',
        'pict',
        'alamat',
        'lat',
        'lng',
        'deleted_at',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    public function jenisPotensi()
    {
        return $this->hasOne(JenisPotensi::class);
    }
}
