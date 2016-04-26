<?php

namespace Jag\Chikka;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use InvalidArgumentException;

class ServiceProvider extends BaseServiceProvider
{

    protected $defer = false;

    public function boot()
    {
        if (! $this->app['config']->has('services.chikka')) {
            throw new InvalidArgumentException('Please add chikka to your services configuration');
        }
    }

    public function register()
    {
        $this->app->singleton('chikka', function ($app) {
            return new Chikka($app, Client::class);
        });
        $this->app->singleton('chikka.client', function ($app) {
            return $app['chikka']->getClient();
        });
        $this->app->singleton('chikka.sender', function ($app) {
            return new Sender($app['chikka']);
        });
    }

    public function provides()
    {
        return ['chikka'];
    }
}
