<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * Customer.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class Customer
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
    private $object = 'customer';

    /**
     * @Accessor("READ")
     * @var boolean $livemode
     */
    private $livemode = false;

    /**
     * @Accessor("READ")
     * @var integer $created
     */
    private $created;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $accountBalance
     */
    private $accountBalance;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var Card $card
     */
    private $card;

    /**
     * @Accessor("READ")
     * @var Card $activeCard
     */
    private $activeCard;

    /**
     * @Accessor("READ")
     * @var boolean $delinquent
     */
    private $delinquent;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $description
     */
    private $description;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $email
     */
    private $email;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var string $plan
     */
    private $plan;

    /**
     * @Accessor({"READ", "WRITE"})
     * @var integer $trialEnd
     */
    private $trialEnd;
}
