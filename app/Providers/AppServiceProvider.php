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
            if (!$this->isIPv4Address(request()->server->get("SERVER_NAME"))) {
                \Illuminate\Support\Facades\URL::forceScheme("https");
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
