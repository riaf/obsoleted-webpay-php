<?php

namespace Webpay;

use Guzzle\Common\Event;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Webpay\Exception\WebpayApiException;
use Webpay\Exception\WebpayCardException;
use Webpay\Exception\WebpayException;
use Webpay\Exception\WebpayRequestException;

class Webpay
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var string $apiKey
     */
    private $apiKey;

    /**
     * @var string $apiSecret
     */
    private $apiSecret;


    /**
     * Constructor.
     *
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct($apiKey = null, $apiSecret = null)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;

        $this->client = new Client();
        $this->client->setDescription(ServiceDescription::factory(__DIR__ . '/Resources/config/service.json'));

        $this->client->getEventDispatcher()->addListener('client.create_request', [$this, 'onClientCreateRequest']);
        $this->client->getEventDispatcher()->addListener('request.error', [$this, 'onRequestError']);
    }

    /**
     * Call Api
     *
     * @param string $command
     * @param mixed $parameters
     * @param array $additionalParameters
     * @return mixed
     */
    public function api($command, $parameters = null, $additionalParameters = [])
    {
        if (is_string($parameters)) {
            $parameters = array_merge(['id' => $parameters], $additionalParameters);
        }

        $command = $this->client->getCommand($command, $parameters);

        return $command->execute();
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     * @return Webpay
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Set baseUrl
     *
     * @param string $baseUrl
     * @return Webpay
     */
    public function setBaseUrl($baseUrl)
    {
        $this->client->setBaseUrl($baseUrl);

        return $this;
    }

    /**
     * @param Event $event
     */
    public function onClientCreateRequest(Event $event)
    {
        $event['request']->setAuth($this->apiKey, '');
    }

    /**
     * @param Event $event
     * @throws WebpayException
     */
    public function onRequestError(Event $event)
    {
        $response = $event['response'];

        if (!$response->isSuccessful()) {
            $code = $response->getStatusCode();
            $data = $response->json();
            $error = isset($data['error']) ? $data['error'] : null;

            $type = isset($error['type']) ? $error['type'] : null;
            $message = isset($error['message']) ? $error['message'] : 'An Unknown Error Occurred.';

            switch ($type) {
                case 'card_error':
                    $e = new WebpayCardException($message, $code);
                    break;

                case 'api_error':
                    $e = new WebpayApiException($message, $code);
                    break;

                case 'invalid_request_error':
                    $e = new WebpayRequestException($message, $code);
                    break;

                default:
                    $e = new WebpayException($message, $code);
            }

            $e->setResponse($response);
            $e->setData($data);

            throw $e;
        }
    }
}
