<?php

namespace App\Providers;

use Google\Auth\Credentials\ServiceAccountCredentials;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;
use Illuminate\Support\Facades\Config;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
         */
        public function register(): void
        {
            //
            $this->app->singleton('firebase', function ($app) {
                $credentials = (__DIR__.'/Credentials.json');

    //
               $factory= (new Factory)
                    ->withServiceAccount($credentials);
//                    ->withProjectId($projctID);

                return $factory->createStorage();
            });
        }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
