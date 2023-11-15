<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        } else {
            $envFile = app()->environmentFilePath();

            if (!$this->isIPv4Address(request()->server->get("SERVER_ADDR"))) {
                \Illuminate\Support\Facades\URL::forceScheme("https");
            } else {
                if (file_exists($envFile) && !preg_match('/\b(192\.168\.100\.31|192\.168\.100\.33)\b/', parse_url(env('API_SERVER'), PHP_URL_HOST))) {
                    $content = file_get_contents($envFile);

                    $content = preg_replace('/API_SERVER=(.*)/m', 'API_SERVER="http://192.168.100.33"', $content);
                    file_put_contents($envFile, $content);
                }

                \Artisan::call('config:clear');
            }
            
            if (in_array(request()->server->get("SERVER_ADDR"), ['192.168.100.31', '192.168.100.33'])) {
                if (file_exists($envFile) && !preg_match('/\b(192\.168\.100\.31|192\.168\.100\.33)\b/', parse_url(env('API_SERVER'), PHP_URL_HOST))) {
                    $content = file_get_contents($envFile);
                    
                    $content = preg_replace('/API_SERVER=(.*)/m', 'API_SERVER="'.request()->server->get("SERVER_ADDR").'"', $content);
                    file_put_contents($envFile, $content);
                }

                \Artisan::call('config:clear');
            }
        }
    }

    function isIPv4Address($ip) {
        $ipv4_pattern = '/^(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.'
                      .'(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.'
                      .'(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)\.'
                      .'(25[0-5]|2[0-4][0-9]|[0-1]?[0-9][0-9]?)$/';
    
        return preg_match($ipv4_pattern, $ip);
    }    
}
