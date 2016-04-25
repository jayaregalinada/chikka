<?php

namespace Jag\Chikka;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{

    protected $defer = false;

    public function boot()
    {
    }

    public function register()
    {
    }

    public function provides()
    {
        return [Chikka::class];
    }
}
