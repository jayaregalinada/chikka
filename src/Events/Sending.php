<?php

namespace Jag\Chikka\Events;

class Sending
{
    /**
     * @var integer
     */
    public $number;

    /**
     * @var string
     */
    public $message;

    /**
     * @var integer
     */
    public $id;

    /**
     * @param integer $number
     * @param string $message
     * @param integer $id
     */
    public function __construct($number, $message, $id = null)
    {
        $this->number = $number;
        $this->message = $message;
        $this->id = $id;
    }
}
