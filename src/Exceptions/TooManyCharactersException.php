<?php

namespace Jag\Chikka\Exceptions;

use Jag\Chikka\Chikka;

class TooManyCharactersException extends \RuntimeException
{
    /**
     * @var integer
     */
    protected $messageLength;

    /**
     * @var string
     */
    protected $message;

    /**
     * @param string $message
     */
    public function __construct($message)
    {
        $this->message = $message;
        $this->messageLength = strlen($message);
        parent::__construct($this->createMessage());
    }

    /**
     * Create the exception message.
     *
     * @return string
     */
    protected function createMessage()
    {
        return 'Cannot send more than ' . Chikka::MESSAGE_LIMIT . ' message limit. Will not process '. $this->messageLength . ' characters.';
    }
}
