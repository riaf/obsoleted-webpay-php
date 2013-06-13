<?php

namespace Webpay\Annotation;

/**
 * @Annotation
 * @Target({"PROPERTY"})
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
final class Accessor
{
    /**
     * @var boolean $readable
     */
    private $readable = false;

    /**
     * @var boolean $writable
     */
    private $writable = false;


    /**
     * @param array $values
     */
    public function __construct(array $values)
    {
        if (!isset($values['value'])) {
            $values['value'] = null;
        }

        if (is_string($values['value'])) {
            $values['value'] = [$values['value']];
        }

        if (!is_array($values['value'])){
            throw new \InvalidArgumentException(
                sprintf('@Accessor expects either a string value, or an array of strings, "%s" given.',
                    is_object($values['value']) ? get_class($values['value']) : gettype($values['value'])
                )
            );
        }

        $values['value'] = array_map('strtoupper', $values['value']);

        foreach ($values['value'] as $prop) {
            if ('WRITE' === $prop) {
                $this->writable = true;
            } else if ('READ' === $prop) {
                $this->readable = true;
            }
        }
    }

    /**
     * Is readable?
     *
     * @return boolean
     */
    public function isReadable()
    {
        return $this->readable;
    }

    /**
     * Is writable?
     *
     * @return boolean
     */
    public function isWritable()
    {
        return $this->writable;
    }
}
