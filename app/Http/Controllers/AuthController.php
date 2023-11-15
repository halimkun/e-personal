<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
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
        if (session()->has('token')) {
            return redirect()->route('home');
        }

        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $response = $this->client->post('auth/login', [
                'json' => [
                    'username' => $request->username,
                    'password' => $request->password,
                ]
            ]);

            $json_response = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('login', ['ref' => $request->ref])->with('error', $json_response['message']);
            }

            $request->session()->put('token', $json_response['access_token']);
            
            if ($request->ref) {
                return redirect()->to($request->ref);
            } else {
                return redirect()->route('home');
            }

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $body = $e->getResponse()->getBody()->getContents();
                $json_response = json_decode($body, true);

                if ($statusCode != 200) {
                    return redirect()->route('login', ['ref' => $request->ref])->with('error', $json_response['message']);
                }

                return redirect()->route('login', ['ref' => $request->ref])->with('error', $json_response['message']);
            } else {
                // Handle jika tidak ada response
                return redirect()->route('login', ['ref' => $request->ref])->with('error', 'Request Error: ' . $e->getMessage());
            }
        }
    }

    public function logout()
    {
        try {
            $local_header = 'Bearer ' . session('token');

            $response = $this->client->post('auth/logout', [
                'headers' => [
                    'Authorization' => $local_header,
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $json_response = json_decode($response->getBody()->getContents(), true);
            $statusCode = $response->getStatusCode();

            if ($statusCode != 200) {
                return redirect()->route('home')->with('error', $json_response['message']);
            }

            session()->forget('token');
            session()->forget('user');
            session()->flush();
            
            return redirect()->route('login');
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $statusCode = $e->getResponse()->getStatusCode();
                $body = $e->getResponse()->getBody()->getContents();
                $json_response = json_decode($body, true);

                if ($statusCode != 200) {
                    return redirect()->route('home')->with('error', $json_response['message']);
                }

                return redirect()->route('home')->with('error', $json_response['message']);
            } else {
                // Handle jika tidak ada response
                return redirect()->route('home')->with('error', 'Request Error: ' . $e->getMessage());
            }
        }
    }
}
