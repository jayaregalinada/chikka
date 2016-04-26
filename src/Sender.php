<?php

namespace Jag\Chikka;

use InvalidArgumentException;

class Sender
{
    /**
     * @var \Jag\Chikka\Chikka
     */
    protected $chikka;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * Message allowed characters.
     *
     * @var integer
     */
    protected $messageLimit = 420;

    /**
     * @param \Jag\Chikka\Chikka $chikka
     */
    public function __construct(Chikka $chikka)
    {
        $this->chikka = $chikka;
        $this->client = $chikka->getClient();
    }

    /**
     * Send a message and return a promise.
     *
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId
     *
     * @return \GuzzleHttp\Promise\Promise
     */
    public function send($mobileNumber, $message, $messageId = null)
    {
        return $this->client->requestAsync('POST', '', ['form_params' => $this->createBody($mobileNumber, $message, $messageId)]);
    }


    /**
     * Send a message immediately.
     *
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public function sendNow($mobileNumber, $message, $messageId = null)
    {
        return $this->client->request('POST', '', ['form_params' => $this->createBody($mobileNumber, $message, $messageId)]);
    }

    /**
     * Create a body to send.
     *
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId
     *
     * @return array
     */
    protected function createBody($mobileNumber, $message, $messageId = null)
    {
        $this->checkMessageLength($message);

        return [
            'message_type' => 'SEND',
            'mobile_number' => $mobileNumber,
            'shortcode' => $this->chikka->getConfiguration('shortcode'),
            'message_id' => (is_null($messageId) ? md5($this->chikka->getConfiguration('shortcode') . '_' . $mobileNumber . '_' . time()) : $messageId),
            'message' => e($message),
            'client_id' => $this->chikka->getConfiguration('key'),
            'secret_key' => $this->chikka->getConfiguration('secret')
        ];
    }

    /**
     * Check message if in the maximum length.
     *
     * @param  string $message
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    protected function checkMessageLength($message)
    {
        if (strlen($message) > $this->messageLimit) {
            throw new InvalidArgumentException('Cannot send more than '. $this->messageLimit .' characters');
        }
    }
}
