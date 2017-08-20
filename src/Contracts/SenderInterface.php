<?php

namespace Jag\Chikka\Contracts;

interface SenderInterface
{
    public function send($mobileNumber, $message, $messageId = null);

    public function sendAsync($mobileNumber, $message, $messageId = null);
}
