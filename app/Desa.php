<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table = 'tb_desa';

    protected $fillable = [
        'nama',
        'colour',
        'area',
    ];

    public function pasar()
    {
        return $this->hasMany(Pasar::class, 'id_desa', 'id');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class, 'id_desa', 'id');
    }

    public function tempatIbadah()
    {
        return $this->hasMany(TempatIbadah::class, 'id_desa', 'id');
    }

    public function jenisPotensi()
    {
        return $this->hasMany(jenisPotensi::class, 'id_desa', 'id');
    }
}
