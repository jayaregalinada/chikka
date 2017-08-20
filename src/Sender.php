<?php

namespace Jag\Chikka;

use Jag\Chikka\Contracts\SenderInterface;
use Jag\Chikka\Exceptions\BadRequestException;
use Jag\Chikka\Exceptions\Exception;
use Jag\Chikka\Exceptions\MethodNotAllowedException;
use Jag\Chikka\Exceptions\NotFoundException;
use Jag\Chikka\Exceptions\UnauthorizedException;
use Jag\Chikka\Forms\SenderForm;
use Jag\Chikka\Responses\SentResponse;
use Psr\Http\Message\ResponseInterface;

class Sender implements SenderInterface
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
     * @var integer
     */
    protected $messageLimit;

    /**
     * @var string
     */
    protected $messageType = 'SEND';

    /**
     * @var \Jag\Chikka\Forms\SenderForm
     */
    protected $requestForm;

    /**
     * @param  \Jag\Chikka\Chikka $chikka
     */
    public function __construct(Chikka $chikka)
    {
        $this->chikka = $chikka;
        $this->client = $chikka->getClient();
        $this->messageLimit = $chikka::MESSAGE_LIMIT;
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
    public function sendAsync($mobileNumber, $message, $messageId = null)
    {
        $this->requestForm = new SenderForm($mobileNumber, $message, $messageId);

        return $this->client->requestAsync('POST', '', ['form_params' => $this->requestForm->get()]);
    }

    /**
     * Send a message immediately.
     *
     * @param  string $mobileNumber
     * @param  string $message
     * @param  string $messageId
     *
     * @throws inherits \Jag\Chikka\Exceptions\Exception
     *
     * @return \Jag\Chikka\Responses\SentResponse
     */
    public function send($mobileNumber, $message, $messageId = null)
    {
        return $this->sendAsync($mobileNumber, $message, $messageId)
        ->then(
            function (ResponseInterface $response) {
                return new SentResponse($response, $this->requestForm);
            },
            function ($exception) {
                return $this->throwError($exception);
            }
        )->wait();
    }

    /**
     * Throw and error based on [https://api.chikka.com/docs/handling-messages#send-sms].
     *
     * @param  inherits \GuzzleHttp\Exception\TransferException  $exception
     *
     * @throws inherits \Jag\Chikka\Exceptions\Exception
     */
    protected function throwError($exception)
    {
        switch ($exception->getResponse()->getStatusCode()) {
            case 400:
                throw new BadRequestException($exception);
                break;

            case 401:
                throw new UnauthorizedException($exception);
                break;

            case 403:
                throw new MethodNotAllowedException($exception);
                break;

            case 404:
                throw new NotFoundException($exception);
                break;

            default:
                throw new Exception($exception);
                break;
        }
    }
}
