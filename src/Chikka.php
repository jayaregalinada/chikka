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
     * @var \Illuminate\Redis\Database
     */
    protected $redis;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Current URL for API Request.
     *
     * @var string
     */
    protected $url = 'https://post.chikka.com/smsapi/request';

    /**
     * Create an instance for chikka.
     *
     * @param \Illuminate\Foundation\Application $app
     * @param \GuzzleHttp\Client $client
     */
    public function __construct($app, $client)
    {
        $this->app = $app;
        $this->checkIfConfigurationExist();
        $this->redis = $app['redis'];
        $this->client = new $client([
            'base_uri' => $this->url,
            'timeout' => 180
        ]);
    }

    /**
     * Check if the configuration is exists in the services.
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function checkIfConfigurationExist()
    {
        if (! $this->app['config']->has('services.chikka')) {
            throw new InvalidArgumentException('Please add chikka to your services configuration');
        }
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
     * Get the configuration but throws error if not exists.
     *
     * @param  string $key
     *
     * @return string
     */
    public function getConfiguration($key)
    {
        if (! $this->app['config']->has('services.chikka.' . $key)) {
            throw new InvalidArgumentException("Please include your [$key] in your Chikka configuration");
        }

        return config('services.chikka.' . $key);
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
     * Gets the value of redis.
     *
     * @return mixed
     */
    public function getRedis()
    {
        return $this->redis;
    }

    /**
     * Sets the value of redis.
     *
     * @param mixed $redis the redis
     *
     * @return self
     */
    protected function setRedis($redis)
    {
        $this->redis = $redis;

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
