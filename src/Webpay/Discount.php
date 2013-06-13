<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Discount.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Discount
{
    use AnnotatedAccessorTrait;

    /**
     * @Accessor("READ")
     * @var string $object
     */
    private $object = 'discount';

    /**
     * @Accessor("READ")
     * @var string $customer
     */
    private $customer;

    /**
     * @Accessor("READ")
     * @var Coupon $coupon
     */
    private $coupon;

    /**
     * @Accessor("READ")
     * @var integer $start
     */
    private $start;

    /**
     * @Accessor("READ")
     * @var integer $end
     */
    private $end;
}
