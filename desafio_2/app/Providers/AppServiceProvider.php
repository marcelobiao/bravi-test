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
        //
        $this->app->bind(
            'App\Repositories\People\PeopleRepository',
            'App\Repositories\People\PeopleEloquent',
        );
        $this->app->bind(
            'App\Repositories\Phone\PhoneRepository',
            'App\Repositories\Phone\PhoneEloquent',
        );
        $this->app->bind(
            'App\Repositories\Email\EmailRepository',
            'App\Repositories\Email\EmailEloquent',
        );
    }
}
