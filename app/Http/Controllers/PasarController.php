<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pasar;
use App\Desa;

class PasarController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function showPasar() {
        $pasar = Pasar::get();
        // return response()->json([
        //     'message' => $sekolah
        // ]);
        return view('pasar', compact('pasar'));
    }

    public function showAddPasar() {
        $desa = Desa::get();
        return view('pasar-tambah', compact('desa'));
    }

    public function showEditPasar($pasar) {
        $desa = Desa::get();
        $pasar = Pasar::where('id', $pasar)->get()->first();
        return view('pasar-edit', compact('desa', 'pasar'));
    }


    public function createPasar(Request $request) {
        $pasar = Pasar::create([
            'id_desa' => $request->desa,
            'id_jenis_potensi' => 2,
            'nama' => $request->nama_pasar,
            'alamat' => $request->alamat_pasar,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        if ($pasar) {
            return redirect()->back()->with('done', 'Pasar berhasil di tambahkan');
        }
        else {
            return redirect()->back()->with('failed', 'Pasar gagal di tambahkan');
        }
    }

    public function deletePasar($pasar) {
        $pasar = Pasar::where('id', $pasar)->delete();
        if ($pasar>0) {
            return redirect()->back()->with('done-delete', 'Pasar berhasil di hapus');
        }
        else {
            return redirect()->back()->with('failed-delete', 'Pasar gagal di hapus');
        }
    }

    public function updatePasar($pasar, Request $request) {
        $pasar = Pasar::where('id', $pasar)->update([
            'id_desa' => $request->desa,
            'id_jenis_potensi' => 2,
            'nama' => $request->nama_pasar,
            'alamat' => $request->alamat_pasar,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);;

        if ($pasar>0) {
            return redirect()->back()->with('done', 'Pasar berhasil di update');
        }
        else {
            return redirect()->back()->with('failed', 'Pasar gagal di update');
        }
    }
}
