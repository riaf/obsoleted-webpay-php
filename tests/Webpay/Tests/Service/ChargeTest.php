<?php

namespace Webpay\Tests\Service;

use Webpay\Webpay;
use Webpay\Charge;

class ChargeTest extends \PHPUnit_Framework_TestCase
{
    private $webpay;

    public function setUp()
    {
        $this->webpay = new Webpay('test_secret_eHn4TTgsGguBcW764a2KA8Yd');
    }

    public function testCreateCharge()
    {
        $charge = $this->webpay->api('charge.create', [
            'amount' => 1000,
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 11,
                'exp_year' => 2014,
                'cvc' => 123,
                'name' => 'KEI KUBO',
            ],
        ]);

        $this->assertInstanceOf('Webpay\\Charge', $charge);
        $this->assertStringStartsWith('ch_', $charge->id);
        // TODO: $charge->card->last4
        $this->assertEquals(4242, $charge->card['last4']);

        return $charge;
    }

    /**
     * @depends testCreateCharge
     */
    public function testGetCharge(Charge $charge)
    {
        $fetchedCharge = $this->webpay->api('charge.get', $charge->id);

        $this->assertInstanceOf('Webpay\\Charge', $fetchedCharge);
        $this->assertEquals($charge->id, $fetchedCharge->id);

        return $fetchedCharge;
    }

    /**
     * @depends testGetCharge
     */
    public function testRefundCharge(Charge $charge)
    {
        $refundedCharge = $this->webpay->api('charge.refund', $charge->id, [
            'amount' => 500,
        ]);

        $this->assertInstanceOf('Webpay\\Charge', $refundedCharge);
        $this->assertEquals($charge->id, $refundedCharge->id);
        $this->assertEquals(500, $refundedCharge->amountRefunded);
    }

    /**
     * @expectedException Webpay\Exception\WebpayCardException
     * @expectedExceptionCode 402
     */
    public function testCreateInvalidCharge()
    {
        try {
            $charge = $this->webpay->api('charge.create', [
                'amount' => 1000,
                'card' => [
                    'number' => '4242424242424243',
                    'exp_month' => 11,
                    'exp_year' => 2014,
                    'cvc' => 123,
                    'name' => 'KEI KUBO',
                ],
            ]);
        } catch (\Webpay\Exception\WebpayCardException $e) {
            $response = $e->getResponse();
            $data = $e->getData();

            $this->assertInstanceOf('Guzzle\Http\Message\Response', $response);
            $this->assertEquals('incorrect_number', $data['error']['code']);

            throw $e;
        }
    }
}
