<?php

namespace Jag\Chikka\Responses;

use GuzzleHttp\Psr7\Response;
use Jag\Chikka\Forms\SenderForm;

class SentResponse
{
    /**
     * @var string
     */
    public $reason;

    /**
     * @var integer
     */
    public $statusCode = 200;

    /**
     * @var array
     */
    public $headers;

    /**
     * @var string
     */
    public $protocol = '1.1';

    /**
     * @var array
     */
    public $body;

    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    protected $response;

    /**
     * @var \Jag\Chikka\Forms\SenderForm
     */
    protected $form;

    /**
     * @param  \GuzzleHttp\Psr7\Response  $response
     * @param  \Jag\Chikka\Forms\SenderForm  $form
     */
    public function __construct(Response $response, SenderForm $form)
    {
        $this->reason = $response->getReasonPhrase();
        $this->statusCode = $response->getStatusCode();
        $this->protocol = $response->getProtocolVersion();
        $this->headers = $response->getHeaders();
        $this->form = $form;
        $this->response = $response;
        $this->body = $this->createBody();
    }

    /**
     * Get the original body contents from \GuzzleHttp\Psr7\Stream.
     *
     * @return mixed
     */
    public function getOriginalBodyContents()
    {
        return $this->response->getBody()->getContents();
    }

    /**
     * Create the body contents.
     *
     * @return array
     */
    protected function createBody()
    {
        return array_merge(json_decode($this->getOriginalBodyContents(), true), [
            'data' => $this->form->get(['mobile_number', 'message', 'message_id'])
        ]);
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return \Jag\Chikka\Forms\SenderForm
     */
    public function getForm()
    {
        return $this->form;
    }
}
