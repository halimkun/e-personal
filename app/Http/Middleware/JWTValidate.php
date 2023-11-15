<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JWTValidate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $path = $request->path();

        $token = session('token');
        if (!$token) {
            session()->flush();
            return redirect()->route('login', ['ref' => $path])->with('error', 'Anda harus login terlebih dahulu!');
        }

        // validate token to auth/me
        $client = new \GuzzleHttp\Client([
            'base_uri' => ENV('API_URL'),
            'timeout' => 120,
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        $response = $client->post('auth/me');
        $json_response = json_decode($response->getBody()->getContents(), true);
        $statusCode = $response->getStatusCode();

        if ($statusCode != 200) {
            session()->flush();
            return redirect()->route('login', ['ref' => $path])->with('error', $json_response['message']);
        }

        // if $json_response['data']['dpt'] null then redirect to login
        if (!$json_response['data']['dpt']) {
            session()->flush();
            return redirect()->route('login', ['ref' => $path])->with('error', 'Anda tidak diizinkan login!');
        }

        $allowed_departments = ['SEKRE', 'DIKLAT', 'SDI', '-'];
        if (!$this->str_containsa($json_response['data']['dpt']['nama'], $allowed_departments)) {
            session()->flush();
            return redirect()->route('login', ['ref' => $path])->with('error', 'Anda tidak diizinkan login!');
        }

        $request->session()->put('user', $json_response['data']);

        return $next($request);
    }

    function str_containsa(string $haystack, array $needles){
        foreach ($needles as $needle){
           if (str_contains($haystack, $needle)){
               return true;
           }
        }
        return false;
    }    
}
