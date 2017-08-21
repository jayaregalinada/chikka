<?php

namespace Jag\Chikka\Exceptions;

class Exception extends \RuntimeException
{
    /**
     * @var \GuzzleHttp\Exception\TransferExcecption
     */
    public $original;

    /**
     * @var integer
     */
    public $statusCode;

    /**
     * @var \GuzzleHttp\Psr7\Stream
     */
    public $body;

    /**
     * @var array
     */
    public $bodyArray;

    /**
     * @param  inherits \GuzzleHttp\Exception\TransferExcecption  $exception
     */
    public function __construct($exception)
    {
        $this->original = $exception;
        $this->statusCode = $exception->getResponse()->getStatusCode();
        $this->body = json_decode($exception->getResponse()->getBody());
        $this->bodyArray = json_decode($exception->getResponse()->getBody(), true);
        parent::__construct($this->body->message, 0, $exception);
    }
}
