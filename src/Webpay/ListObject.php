<?php

namespace Webpay;

use Webpay\Annotation\Accessor;
use Webpay\Traits\AnnotatedAccessorTrait;

/**
 * ListObject.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
class ListObject implements \IteratorAggregate
{
    use AnnotatedAccessorTrait;

    /**
     * @Accessor("READ")
     * @var string $object
     */
    private $object = 'list';

    /**
     * @Accessor("READ")
     * @var string $url
     */
    private $url;

    /**
     * @Accessor("READ")
     * @var integer $count
     */
    private $count;

    /**
     * @Accessor("READ")
     * @var array $data
     */
    private $data = [];


    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }
}
