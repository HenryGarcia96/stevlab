<?php

namespace App\Providers;

use App\Actions\Jetstream\DeleteUser;
use Illuminate\Support\ServiceProvider;
use Laravel\Jetstream\Jetstream;

class JetstreamServiceProvider extends ServiceProvider
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
        $this->configurePermissions();

        Jetstream::deleteUsersUsing(DeleteUser::class);
        
         // we now register our new classes to override the default classes for but normal login and two factor authentication
        // $this->app->singleton(
        //     \Laravel\Fortify\Contracts\LoginResponse::class,
        //     \App\Http\Responses\LoginResponse::class
        // );
        // $this->app->singleton(
        //     \Laravel\Fortify\Contracts\TwoFactorLoginResponse::class,
        //     \App\Http\Responses\LoginResponse::class
        // );
    }

    /**
     * Configure the permissions that are available within the application.
     *
     * @return void
     */
    protected function configurePermissions()
    {
        Jetstream::defaultApiTokenPermissions(['read']);

        Jetstream::permissions([
            'create',
            'read',
            'update',
            'delete',
        ]);
    }
}
