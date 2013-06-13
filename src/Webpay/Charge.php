<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Charge.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Charge extends AbstractObject
{
    use AnnotatedAccessorTrait;

    /**
     * @Accessor("READ")
     * @var string $id
     */
    private $id;

    /**
     * @Accessor("READ")
     * @var string $object
     */
    private $object = 'charge';

    /**
     * @Accessor("READ")
     * @var boolean
     */
    private $livemode = false;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $amount
     */
    private $amount;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var Card $card
     */
    private $card;

    /**
     * @Accessor("READ")
     * @var integer $created
     */
    private $created;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $currency
     */
    private $currency = 'jpy';

    /**
     * @Accessor("READ")
     * @var boolean $disputed
     */
    private $disputed = false;

    /**
     * @Accessor("READ")
     * @var boolean $paid
     */
    private $paid = false;

    /**
     * @Accessor("READ")
     * @var boolean $refunded
     */
    private $refunded = false;

    /**
     * @Accessor("READ")
     * @var integer $amountRefunded
     */
    private $amountRefunded;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $customer
     */
    private $customer;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $description
     */
    private $description;

    /**
     * @Accessor("READ")
     * @var string $failureMessage
     */
    private $failureMessage;
}
