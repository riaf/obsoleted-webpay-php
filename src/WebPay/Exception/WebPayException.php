<?php

namespace WebPay\Exception;

use Guzzle\Http\Message\Response;

class WebPayException extends \RuntimeException
{
    /**
     * @var Response $response
     */
    protected $response;

    /**
     * @var array $data
     */
    protected $data;

    /**
     * Set response.
     *
     * @param Response $response
     * @return WebPayException
     */
    public function setResponse(Response $response = null)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Get response.
     *
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Set data.
     *
     * @param array $data
     * @return WebPayException
     */
    public function setData($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}

