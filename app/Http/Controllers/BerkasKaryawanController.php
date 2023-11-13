<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerkasKaryawanController extends Controller
{
    public function index(Request $request)
    {
        $nik = null;
        if ($request->nik) {
            $nik = $request->nik;
        }

        return view("karyawan_berkas.index", [
            "dnik"=> $nik
        ]);
    }

    // view
    public function view(Request $request)
    {
        if (!$request->kode) {
            return redirect()->route("berkas_karyawan.index");
        }

        if (!$request->nik) {
            return redirect()->route("berkas_karyawan.index");
        }

        $nik = $request->nik;
        $kode = $request->kode;

        return view("karyawan_berkas.view", [
            "kode"=> $kode,
            'nik' => $nik
        ]);
    }
}
