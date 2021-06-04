<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'tb_sekolah';

    protected $fillable = [
        'id_desa',
        'id_jenjang',
        'id_jenis_potensi',
        'nama',
        'pict',
        'jenis_sekolah',
        'alamat',
        'lat',
        'lng',
        'deleted_at',
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function jenisPotensi()
    {
        return $this->belongsTo(JenisPotensi::class);
    }

    public function jenjang()
    {
        return $this->hasOne(Jenjang::class, 'id', 'id_jenjang');
    }
}
