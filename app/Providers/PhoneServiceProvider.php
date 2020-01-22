<?php

namespace App\Providers;

use App\Services\PhoneService;
use Illuminate\Support\ServiceProvider;

class PhoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(PhoneService::class, function() {
            $provider = config('phone.provider');
            $config = config("services.$provider");
            return new PhoneService($config);
        });
    }
}
