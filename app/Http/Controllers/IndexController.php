<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desa;
use App\Sekolah;
use App\TempatIbadah;
use App\Pasar;
use App\Agama;
use App\Jenjang;

class IndexController extends Controller
{
    public function showHome() {
        $desa = Desa::get();
        $pasar = Pasar::get();
        $sekolah = Sekolah::get();
        $tempatIbadah = TempatIbadah::get();
        $jenjang = Jenjang::get();
        $agama = Agama::get();

        return view('welcome', compact('desa', 'pasar', 'sekolah', 'tempatIbadah', 'jenjang', 'agama'));
    }
}
