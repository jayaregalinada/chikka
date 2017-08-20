<?php

namespace Jag\Chikka;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Jag\Chikka\EventServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @var boolean
     */
    protected $defer = false;

    /**
     * Other services.
     *
     * @var array
     */
    protected $otherServices = [
        EventServiceProvider::class,
    ];

    /**
     * @return void
     */
    public function boot()
    {
        $this->mergeConfig();
    }

    /**
     * @return void
     */
    public function register()
    {
        $this->registerChikka();
        $this->registerChikkaSender();
        $this->registerOtherServices();
    }

    /**
     * @return array
     */
    public function provides()
    {
        return ['chikka', 'chikka.sender'];
    }

    /**
     * Merge the configuration.
     *
     * @return void
     */
    protected function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'chikka'
        );
    }

    /**
     * Register the \Jag\Chikka\Chikka.
     *
     * @return void
     */
    protected function registerChikka()
    {
        $this->app->singleton('chikka', function ($app) {
            return new Chikka($app, Client::class);
        });
    }

    /**
     * Register the \Jag\Chikka\Sender.
     *
     * @return void
     */
    protected function registerChikkaSender()
    {
        $this->app->singleton('chikka.sender', function ($app) {
            return new Sender($app['chikka']);
        });
    }

    /**
     * Register the other services included.
     *
     * @return void
     */
    protected function registerOtherServices()
    {
        foreach ($this->otherServices as $service) {
            $this->app->register($service);
        }
    }
}
