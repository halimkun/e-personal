<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SuratController extends Controller
{
    public function internal() 
    {
        return view('surat.internal');
    }
}
