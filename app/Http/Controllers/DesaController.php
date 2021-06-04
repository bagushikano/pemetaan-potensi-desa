<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Desa;

class DesaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function showDesa() {
        $desa = Desa::get();
        return view('desa', compact('desa'));
    }

    public function showAddDesa() {
        return view('desa-tambah');
    }

    public function showEditDesa(Desa $desa) {
        $desa = Desa::where('id', $desa->id)->get()->first();
        return view('desa-edit', compact('desa'));
    }

    public function createDesa(Request $request) {
        $this->validate($request,[
            'nama_desa' => "required|min:3|max:100",
        ],
        [
            'nama_desa.required' => "Nama desa wajib diisi",
            'nama_desa.min' => "Nama desa minimal berjumlah 3 karakter",
            'nama_desa.max' => "Nama desa maksimal berjumlah 50 karakter",
        ]);

        $desa = Desa::create([
            'nama' => $request->nama_desa,
            'area' => $request->koordinat,
        ]);

        if ($desa) {
            return redirect()->back()->with('done', 'Desa berhasil di tambahkan');
        }
        else {
            return redirect()->back()->with('failed', 'Desa gagal di tambahkan');
        }
    }

    public function deleteDesa($desa) {
        $desa = Desa::where('id', $desa)->delete();
        if ($desa>0) {
            return redirect()->back()->with('done-delete', 'Desa berhasil di hapus');
        }
        else {
            return redirect()->back()->with('failed-delete', 'Desa gagal di hapus');
        }
    }

    public function updateDesa(Desa $desa, Request $request) {
        $desa = Desa::where('id', $desa->id)->update([
            'nama' => $request->nama_desa,
            'area' => $request->koordinat,
        ]);;

        if ($desa>0) {
            return redirect()->back()->with('done', 'Desa berhasil di update');
        }
        else {
            return redirect()->back()->with('failed', 'Desa gagal di update');
        }
    }
}
