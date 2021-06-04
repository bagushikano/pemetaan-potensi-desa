<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenjang extends Model
{
    protected $table = 'tb_jenjang_sekolah';

    protected $fillable = [
        'jenjang',
    ];

    public function sekolah()
    {
        return $this->belongsTo(Sekolah::class);
    }
}
