<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Teamwork;
use GuzzleHttp\Client;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Teamwork', function ($app) {
            $client = new Client([
                'base_uri' => config('teamwork.endpoint'),
                'timeout'  => 5.0,
                'auth' => [config('teamwork.key'), 'X'],
            ]);
            return new Teamwork($client);
        });
    }
}
