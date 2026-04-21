<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Carbon::setLocale('id');
        Paginator::useBootstrapFive();
        Authenticate::redirectUsing(function(){
            session()->flash('auth_error', 'Silahkan Login Untuk Melanjutkan');
            return route('rumahgue');
        });
    }
}
