<?php

namespace Jag\Chikka\Forms;

use Jag\Chikka\Chikka;
use Jag\Chikka\Exceptions\TooManyCharactersException;

class SenderForm
{
    /**
     * @var integer|string
     */
    public $mobile;

    /**
     * @var string
     */
    public $message;

    /**
     * @var mixed
     */
    public $id;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var string
     */
    protected $originalMessage;

    /**
     * @var string
     */
    protected $messageType = 'SEND';

    /**
     * @param  integer|string  $mobile
     * @param  string  $message
     * @param  mixed  $id
     */
    public function __construct($mobile, $message, $id = null)
    {
        $this->checkMessageLength($message);
        $this->config = config('chikka');
        $this->mobile = $mobile;
        $this->message = e($message);
        $this->id = $this->createId($id);
        $this->originalMessage = $message;
    }

    /**
     * @return string
     */
    public function getOriginalMessage()
    {
        return $this->originalMessage;
    }

    /**
     * Get the attribute.
     *
     * @return array
     */
    public function get($key = null)
    {
        $attributes = [
            'message_type' => $this->messageType,
            'mobile_number' => $this->mobile,
            'message_id' => $this->id,
            'message' => $this->message,
            'shortcode' => $this->config['shortcode'],
            'client_id' => $this->config['key'],
            'secret_key' => $this->config['secret'],
        ];

        return (is_null($key) ? $attributes : collect($attributes)->only($key)->toArray());
    }

    /**
     * Create a message id.
     *
     * @param  mixed  $id
     *
     * @return mixed
     */
    protected function createId($id)
    {
        if (is_null($id)) {
            return md5(join('_', [
                $this->config['shortcode'],
                $this->mobile,
                time(),
            ]));
        }

        return $id;
    }

    /**
     * Throws an error if message exceed the message limit [420]
     *
     * @param  string  $message
     *
     * @throws TooManyCharactersException
     *
     * @return void
     */
    protected function checkMessageLength($message)
    {
        if (strlen($message) > Chikka::MESSAGE_LIMIT) {
            throw new TooManyCharactersException($message);
        }
    }
}
