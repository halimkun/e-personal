<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    protected $client;
    protected $headers;

    public function __construct()
    {
        $this->headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ];

        $this->client = new \GuzzleHttp\Client([
            'base_uri' => ENV('API_URL'),
            'timeout' => 120,
            'headers' => $this->headers,
        ]);
    }

    public function index()
    {
        return view('karyawan.index');
    }

}
