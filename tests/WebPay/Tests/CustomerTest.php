<?php

namespace WebPay\Tests;

use WebPay\WebPay;

class CustomerTest extends \PHPUnit_Framework_TestCase
{
    private $webpay;

    public function setUp()
    {
        $this->webpay = new WebPay('test_secret_eHn4TTgsGguBcW764a2KA8Yd');
    }

    public function testCreateCustomer()
    {
        $customer = $this->webpay->api('customer.create', [
            'email' => 'webpay@example.com',
            'description' => 'webpay-php tests',
            'card' => [
                'number' => '4242424242424242',
                'exp_month' => 11,
                'exp_year' => 2014,
                'cvc' => 123,
                'name' => 'KEI KUBO',
            ],
        ]);

        $this->assertInternalType('array', $customer);
        $this->assertStringStartsWith('cus_', $customer['id']);
        $this->assertEquals(4242, $customer['active_card']['last4']);

        return $customer;
    }

    /**
     * @depends testCreateCustomer
     */
    public function testGetCustomer(array $customer)
    {
        $fetchedCustomer = $this->webpay->api('customer.get', $customer['id']);

        $this->assertInternalType('array', $fetchedCustomer);
        $this->assertEquals($customer['id'], $fetchedCustomer['id']);

        return $fetchedCustomer;
    }

    /**
     * @depends testGetCustomer
     */
    public function testUpdateCustomer(array $customer)
    {
        $updatedCustomer = $this->webpay->api('customer.update', $customer['id'], [
            'email' => 'webpay2@example.com',
        ]);

        $this->assertInternalType('array', $updatedCustomer);
        $this->assertEquals($customer['id'], $updatedCustomer['id']);
        $this->assertEquals('webpay2@example.com', $updatedCustomer['email']);
    }

    /**
     * @expectedException WebPay\Exception\WebPayCardException
     * @expectedExceptionCode 402
     */
    public function testCreateInvalidCustomer()
    {
        try {
            $customer = $this->webpay->api('customer.create', [
                'card' => [
                    'number' => '4242424242424243',
                    'exp_month' => 11,
                    'exp_year' => 2014,
                    'cvc' => 123,
                    'name' => 'KEI KUBO',
                ],
            ]);
        } catch (\WebPay\Exception\WebPayCardException $e) {
            $response = $e->getResponse();
            $data = $e->getData();

            $this->assertInstanceOf('Guzzle\Http\Message\Response', $response);
            $this->assertEquals('incorrect_number', $data['error']['code']);

            throw $e;
        }
    }
}

