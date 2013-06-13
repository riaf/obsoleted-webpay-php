<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Plan.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Plan
{
    use AnnotatedAccessorTrait;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $id
     */
    private $id;

    /**
     * @Accessor("READ")
     * @var string $object
     */
    private $object = 'plan';

    /**
     * @Accessor("READ")
     * @var boolean $livemode
     */
    private $livemode = false;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $amount
     */
    private $amount;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $currency
     */
    private $currency = 'jpy';

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $interval
     */
    private $interval;

    /**
     * @Accessor("READ")
     * @var integer $intervalCount
     */
    private $intervalCount;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $trialPeriodDays
     */
    private $trialPeriodDays;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $name
     */
    private $name;
}
