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

    public function create(Request $request)
    {
        $data = $this->mapFormData($request);
        
        try {
            $this->headers['Authorization'] = 'Bearer ' . session('token');
            $response = $this->client->post('pegawai/store', [
                'json' => $data,
                'headers' => $this->headers
            ]);

            $json_response = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('karyawan.new')->with('error', $json_response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $json_response['message']);
        } catch (\Exception $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);
            $statusCode = $e->getResponse()->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('karyawan.new')->with('error', $response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $response['message']);
        }
    }

    public function update(Request $request)
    {
        $data = $this->mapFormData($request);
        $data['nik'] = $request->nik;

        $this->headers['Authorization'] = 'Bearer ' . session('token');

        try {
            $response = $this->client->post('pegawai/update', [
                'json' => $data,
                'headers' => $this->headers
            ]);

            // Handle the response
            $json_response = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('karyawan.new')->with('error', $json_response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $json_response['message']);
        } catch (\Exception $e) {
            $response = json_decode($e->getResponse()->getBody()->getContents(), true);
            $statusCode = $e->getResponse()->getStatusCode();


            if ($statusCode != 200) {
                return redirect()->back()->with('error', $response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $response['message']);
        }
    }

    public function delete(Request $request)
    {
        if (!$request->nik) {
            return redirect()->route('karyawan.index')->with('error', 'Request tidak lengkap, silahkan coba lagi');
        }

        try {
            $this->headers['Authorization'] = 'Bearer ' . session('token');
            $response = $this->client->delete('pegawai/destroy', [
                'json' => [
                    'nik' => $request->nik
                ],
                'headers' => $this->headers
            ]);

            $json_response = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();


            if ($statusCode != 200) {
                return redirect()->route('karyawan.index')->with('error', $json_response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $json_response['message']);
        } catch (\Throwable $th) {
            $response = json_decode($th->getResponse()->getBody()->getContents(), true);
            $statusCode = $th->getResponse()->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('karyawan.index')->with('error', $response['message']);
            }

            return redirect()->route('karyawan.index')->with('success', $response['message']);
        }
    }

    public function new()
    {
        $data = [
            'action' => "karyawan.create",
        ];

        return view('karyawan.form', $data);
    }

    public function edit($nik)
    {
        $data = [
            'action' => "karyawan.update",
            'nik' => $nik,
        ];

        return view('karyawan.form', $data);
    }


    private function getFormAction($segment)
    {
        switch ($segment) {
            case in_array('new', $segment):
                return 'karyawan.create';
                break;
            case in_array('edit', $segment):
                return 'karyawan.update';
                break;
            default:
                return 'karyawan.create';
                break;
        }
    }

    private function mapFormData($request)
    {
        $pegawai_column = ["id" => 0, "nik" => "-", "nama" =>	"-", "jk" =>	"-", "jbtn" =>	"-", "jnj_jabatan" =>	"-", "kode_kelompok" =>	"-", "kode_resiko" =>	"-", "kode_emergency" => "-", /**"status_koor" =>	0,*/ "departemen" =>	"-", "bidang" =>	"-", "stts_wp" =>	"-", "stts_kerja" =>	"-", "npwp" =>	"-", "pendidikan" =>	"-", "gapok" =>	0, "tmp_lahir" => "-", "tgl_lahir" =>	"0000-00-00", "alamat" =>	"-", "kota" =>	"-", "mulai_kerja" => "0000-00-00", "ms_kerja" =>	"-", "indexins" =>	"-", "bpd" =>	"-", "rekening" =>	"-", "stts_aktif" => "-", "wajibmasuk" =>	0, "pengurang" =>	0, "indek" =>	0, "mulai_kontrak" => "0000-00-00", "cuti_diambil" =>	0, "dankes" => 0, "photo" => "-", "no_ktp" => "-"];
        $petugas_column = ["nip" => "-", "nama" => "-", "jk" => "-", "tmp_lahir" => "-", "tgl_lahir" => "0000-00-00", "gol_darah" => "-", "agama" => "-", "stts_nikah" => "-", "alamat" => "-", "kd_jbtn" => "-", "no_telp" => "-", "status" => "-"];
        $rsia_departemen_jm_column = ["id_jm" => 0, "nik" => "-", "dep_id" => "-"];

        $pegawai_data = [];
        $petugas_data = [];
        $rsia_departemen_jm_column_data = [];
        
        foreach ($pegawai_column as $columns_name => $default_value) {
            $pegawai_data[$columns_name] = ucwords($request->has($columns_name) ? $request->input($columns_name) : $default_value);
        }

        $pegawai_data['id'] = $request->has('data') ? $request->input('data') : 0;

        foreach ($petugas_column as $columns_name => $default_value) {
            $petugas_data[$columns_name] = ucwords($request->has($columns_name) ? $request->input($columns_name) : $default_value);

            if ($columns_name == 'nip') {
                $petugas_data[$columns_name] = $request->has('nik') ? $request->input('nik') : '-';
            }

            if ($columns_name == 'jk') {
                $petugas_data[$columns_name] = $petugas_data[$columns_name] == 'Pria' ? 'L' : 'P';
            }
        }

        foreach ($rsia_departemen_jm_column as $columns_name => $default_value) {
            $rsia_departemen_jm_column_data[$columns_name] = ucwords($request->has($columns_name) ? $request->input($columns_name) : $default_value);
        }

        $rsia_departemen_jm_column_data['id_jm'] = $request->has('data') ? $request->input('data') : 0;

        $data = [
            'pegawai' => $pegawai_data,
            'petugas' => $petugas_data,
            'rsia_departemen_jm' => $rsia_departemen_jm_column_data
        ];

        return $data;
    }
}
