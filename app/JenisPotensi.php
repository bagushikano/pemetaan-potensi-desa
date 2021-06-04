<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisPotensi extends Model
{
    protected $table = 'tb_jenis_potensi';

    protected $fillable = [
        'id_desa',
        'jenis',
        'icon',
    ];

    public function tempatIbadah()
    {
        return $this->belongsTo(TempatIbadah::class);
    }

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }

    public function pasar()
    {
        return $this->belongsTo(Pasar::class);
    }
}
