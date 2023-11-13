<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerkasKaryawanController extends Controller
{
    public function index() {
        return view("karyawan_berkas.index");
    }
}
