<?php

namespace Jag\Chikka;

use InvalidArgumentException;

class Chikka
{
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
     * Create an instance for chikka.
     *
     * @param \Illuminate\Foundation\Application $app
     * @param \GuzzleHttp\Client $client
     */
    public function __construct($app, $client, $uri = null)
    {
        $this->app = $app;
        $this->url = (is_null) ? config('chikka.uri') : $uri;
        $this->client = new $client([
            'base_uri' => $this->url,
            'timeout' => config('chikka.timeout'),
        ]);
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
        return (new Sender($this))->send($mobileNumber, $message, $messageId);
    }

    /**
     * Send capability without async.
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId    [description]
     * @return [type]               [description]
     */
    public function sendNow($mobileNumber, $message, $messageId = null)
    {
        return (new Sender($this))->sendNow($mobileNumber, $message, $messageId);
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
     * Sets the value of app.
     *
     * @param mixed $app the app
     *
     * @return self
     */
    protected function setApp($app)
    {
        $this->app = $app;

        return $this;
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

    /**
     * Sets the value of client.
     *
     * @param mixed $client the client
     *
     * @return self
     */
    protected function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
}
