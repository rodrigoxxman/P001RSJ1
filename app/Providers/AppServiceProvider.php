<?php

namespace CRMApp\Providers;

use Illuminate\Support\ServiceProvider;

//agregar schema
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        //Para error 1071 Specified key was too long;
        Schema::defaultStringLength(191);
    }
}
