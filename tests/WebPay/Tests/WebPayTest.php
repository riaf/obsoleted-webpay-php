<?php

namespace WebPay\Tests;

use WebPay\WebPay;

class WebPayTest extends \PHPUnit_Framework_TestCase
{
    private $webpay;

    public function setUp()
    {
        $this->webpay = new WebPay();
        $this->webpay->setApiKey('test_secret_eHn4TTgsGguBcW764a2KA8Yd');
        $this->webpay->setBaseUrl('http://localhost');
    }

    public function testExceptions()
    {
        $response = $this->getMockBuilder('Guzzle\\Http\\Message\\Response')
            ->disableOriginalConstructor()
            ->getMock();

        // Always be failed
        $response->expects($this->any())
            ->method('isSuccessful')
            ->will($this->returnValue(false));

        // status code is "401"
        $response->expects($this->any())
            ->method('getStatusCode')
            ->will($this->returnValue(401));

        // error data
        $response->expects($this->any())
            ->method('json')
            ->will($this->onConsecutiveCalls([
                'error' => [
                    'type' => 'card_error',
                    'message' => 'card_error',
                ],
            ], [
                'error' => [
                    'type' => 'api_error',
                    'message' => 'api_error',
                ],
            ], [
                'error' => [
                    'type' => 'invalid_request_error',
                    'message' => 'invalid_request_error',
                ],
            ], [
                'error' => [
                    'type' => 'unknown_error',
                    'message' => 'unknown_error',
                ],
            ]));

        $event = $this->getMock('Guzzle\\Common\\Event', null, [
            [
                'response' => $response,
            ],
        ]);

        // card_error
        try {
            $this->webpay->onRequestError($event);
        } catch (\WebPay\Exception\WebPayCardException $e) {
            $this->assertInstanceOf('Guzzle\\Http\\Message\\Response', $e->getResponse());
            $this->assertEquals(401, $e->getCode());
            $this->assertArrayHasKey('error', $e->getData());
        }

        // api_error
        try {
            $this->webpay->onRequestError($event);
        } catch (\WebPay\Exception\WebPayApiException $e) {
            $this->assertInstanceOf('Guzzle\\Http\\Message\\Response', $e->getResponse());
            $this->assertEquals(401, $e->getCode());
            $this->assertArrayHasKey('error', $e->getData());
        }

        // invalid_request_error
        try {
            $this->webpay->onRequestError($event);
        } catch (\WebPay\Exception\WebPayRequestException $e) {
            $this->assertInstanceOf('Guzzle\\Http\\Message\\Response', $e->getResponse());
            $this->assertEquals(401, $e->getCode());
            $this->assertArrayHasKey('error', $e->getData());
        }

        // unknown_error
        try {
            $this->webpay->onRequestError($event);
        } catch (\WebPay\Exception\WebPayException $e) {
            $this->assertInstanceOf('Guzzle\\Http\\Message\\Response', $e->getResponse());
            $this->assertEquals(401, $e->getCode());
            $this->assertArrayHasKey('error', $e->getData());
        }
    }
}
