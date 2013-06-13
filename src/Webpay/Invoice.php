<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Invoice.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Invoice
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
    private $object = 'invoice';

    /**
     * @Accessor("READ")
     * @var boolean $livemode
     */
    private $livemode;

    /**
     * @Accessor("READ")
     * @var string $currency
     */
    private $currency = 'jpy';

    /**
     * @Accessor("READ")
     * @var integer $discount
     */
    private $discount;

    /**
     * @Accessor("READ")
     * @var boolean $attempted
     */
    private $attempted;

    /**
     * @Accessor("READ")
     * @var integer $nextPaymentAttempt
     */
    private $nextPaymentAttempt;

    /**
     * @Accessor("READ")
     * @var integer $subtotal
     */
    private $subtotal;

    /**
     * @Accessor("READ")
     * @var string $charge
     */
    private $charge;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $customer
     */
    private $customer;

    /**
     * @Accessor("READ")
     * @var integer $amountDue
     */
    private $amountDue;

    /**
     * @Accessor("READ")
     * @var boolean $paid
     */
    private $paid;

    /**
     * @Accessor("READ")
     * @var integer $startingBalance
     */
    private $startingBalance;

    /**
     * @Accessor("READ")
     * @var integer $endingBalance
     */
    private $endingBalance;

    /**
     * @Accessor("READ")
     * @var integer $date
     */
    private $date;

    /**
     * @Accessor("READ")
     * @var integer $attemptCount
     */
    private $attemptCount;

    /**
     * @Accessor("READ")
     * @var integer $total
     */
    private $total;

    /**
     * @Accessor("READ")
     * @var integer $periodStart
     */
    private $periodStart;

    /**
     * @Accessor("READ")
     * @var integer $periodEnd
     */
    private $periodEnd;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var boolean
     */
    private $closed;

    /**
     * @Accessor("READ")
     * @var List $lines
     */
    private $lines;
}
