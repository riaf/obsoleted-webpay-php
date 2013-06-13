<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Subscription.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Subscription
{
    use AnnotatedAccessorTrait;

    /**
     * @Accessor("READ")
     * @var string $object
     */
    private $object = 'subscription';

    /**
     * @Accessor({"READ", "WRITE"})
     * @var Customer|string $customer
     */
    private $customer;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var Card|string $card
     */
    private $card;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var Plan|string $plan
     */
    private $plan;

    /**
     * @Accessor("READ")
     * @var string $status
     */
    private $status;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $trialStart
     */
    private $trialStart;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $trialEnd
     */
    private $trialEnd;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $endedAt
     */
    private $endedAt;

    /**
     * @Accessor("READ")
     * @var integer $currentPeriodStart
     */
    private $currentPeriodStart;

    /**
     * @Accessor("READ")
     * @var integer $currentPeriodEnd
     */
    private $currentPeriodEnd;

    /**
     * @Accessor("READ")
     * @var integer $cancelAtPeriodEnd
     */
    private $cancelAtPeriodEnd;

    /**
     * @Accessor("READ")
     * @var integer $canceledAt
     */
    private $canceledAt;

    /**
     * @Accessor("READ")
     * @var integer $quantity
     */
    private $quantity;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var boolean $prorate
     */
    private $prorate;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $atPeriodEnd
     */
    private $atPeriodEnd;
}
