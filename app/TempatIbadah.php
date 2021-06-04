<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempatIbadah extends Model
{
    protected $table = 'tb_tempat_ibadah';

    protected $fillable = [
        'id_desa',
        'id_jenis_potensi',
        'id_agama',
        'nama',
        'pict',
        'alamat',
        'lng',
        'lat',
        'deleted_at',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    public function jenisPotensi()
    {
        return $this->hasOne(Desa::class, 'id_jenis_potensi', 'id');
    }

    public function agama()
    {
        return $this->hasOne(Agama::class, 'id', 'id_agama');
    }
}
