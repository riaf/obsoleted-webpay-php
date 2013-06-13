<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Coupon.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Coupon
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
    private $object = 'coupon';

    /**
     * @Accessor("READ")
     * @var boolean $livemode
     */
    private $livemode = false;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $currency
     */
    private $currency = 'jpy';

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $duration
     */
    private $duration;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $percentOff
     */
    private $percentOff;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $amountOff
     */
    private $amountOff;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $maxRedemptions
     */
    private $maxRedemptions;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $durationInMonths
     */
    private $durationInMonths;

    /**
     * @Accessor("READ")
     * @var integer $timesRedeemed
     */
    private $timesRedeemed;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $redeemBy
     */
    private $redeemBy;
}
