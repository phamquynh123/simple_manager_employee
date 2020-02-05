<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->app->bind("App\\Repositories\\User\\UserRepositoryInterface","App\\Repositories\\User\\UserRepository");
        $this->app->bind("App\\Repositories\\Room\\RoomRepositoryInterface","App\\Repositories\\Room\\RoomRepository");
        $this->app->bind("App\\Repositories\\Role\\RoleRepositoryInterface","App\\Repositories\\Role\\RoleRepository");
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
