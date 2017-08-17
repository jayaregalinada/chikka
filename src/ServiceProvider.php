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
        $this->mergeConfig();
    }

    public function register()
    {
        $this->registerChikka();
        $this->registerChikkaClient();
        $this->registerChikkaSender();
    }

    public function provides()
    {
        return ['chikka'];
    }

    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'chikka'
        );
    }

    protected function registerChikka()
    {
        $this->app->singleton('chikka', function ($app) {
            return new Chikka($app, Client::class);
        });
    }

    protected function registerChikkaClient()
    {
        $this->app->singleton('chikka.client', function ($app) {
            return $app['chikka']->getClient();
        });
    }

    protected function registerChikkaSender()
    {
        $this->app->singleton('chikka.sender', function ($app) {
            return new Sender($app['chikka']);
        });
    }
}
