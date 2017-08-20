<?php

namespace Jag\Chikka;

use InvalidArgumentException;
use Jag\Chikka\Contracts\SenderInterface;

class Chikka implements SenderInterface
{
    /**
     * Maximum message limit.
     */
    const MESSAGE_LIMIT = 420;

    /**
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Current URL for API Request.
     *
     * @var string
     */
    protected $url;

    /**
     * @var array
     */
    public $config;

    /**
     * Create an instance for chikka.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @param  \GuzzleHttp\Client $client
     */
    public function __construct($app, $client, $uri = null)
    {
        $this->app = $app;
        $this->url = (is_null($uri)) ? $app['config']->get('chikka.uri') : $uri;
        $this->client = new $client([
            'base_uri' => $this->url,
            'timeout' => $app['config']->get('chikka.timeout')
        ]);
        $this->config = $app['config']->get('chikka');
    }

    /**
     * Send capability.
     *
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId
     *
     * @return \GuzzleHttp\Promise\Promise
     */
    public function send($mobileNumber, $message, $messageId = null)
    {
        return $this->app['chikka.sender']->send($mobileNumber, $message, $messageId);
    }

    /**
     * Send capability without async.
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId    [description]
     * @return [type]               [description]
     */
    public function sendAsync($mobileNumber, $message, $messageId = null)
    {
        return $this->app['chikka.sender']->sendAsync($mobileNumber, $message, $messageId);
    }

    /**
     * Gets the value of app.
     *
     * @return mixed
     */
    public function getApp()
    {
        return $this->app;
    }

    /**
     * Gets the value of url.
     *
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Gets the value of client.
     *
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }
}
