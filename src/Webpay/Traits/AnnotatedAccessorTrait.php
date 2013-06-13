<?php

namespace Webpay\Traits;

use \ReflectionClass;
use Doctrine\Common\Annotations\AnnotationException;
use Doctrine\Common\Annotations\AnnotationReader;
use Webpay\Annotation\Accessor as AccessorAnnotation;

/**
 * AnnotatedAccessorTrait.
 *
 * @author Keisuke SATO <sato.keisuke@facebook.com>
 */
trait AnnotatedAccessorTrait
{
    /**
     * __get
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($this->isReadableProperty($name)) {
            return isset($this->{$name}) ? $this->{$name} : null;
        }

        $trace = debug_backtrace();
        trigger_error(
            'Access to read protected property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
    }

    /**
     * __isset
     *
     * @param string $name
     * @return mixed
     */
    public function __isset($name)
    {
        if ($this->isReadableProperty($name)) {
            return isset($this->{$name});
        }

        return false;
    }

    /**
     * __set
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        if ($this->isWritableProperty($name)) {
            return $this->{$name} = $value;
        }

        $trace = debug_backtrace();
        trigger_error(
            'Access to write protected property via __set(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
    }

    /**
     * __unset
     *
     * @param string $name
     * @param mixed $value
     */
    public function __unset($name)
    {
        if ($this->isWritableProperty($name)) {
            return $this->{$name} = null;
        }

        $trace = debug_backtrace();
        trigger_error(
            'Access to write protected property via __unset(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
    }

    private function isReadableProperty($name)
    {
        return $this->getAnnotatedDefinition($name, 'readable', false);
    }

    private function isWritableProperty($name)
    {
        return $this->getAnnotatedDefinition($name, 'writable', false);
    }

    private function getAnnotatedDefinition($name, $mode, $default = null)
    {
        static $defs = [
            'initialized' => false,
            'props' => [],
        ];

        if (class_exists('Webpay\\Annotation\\Accessor') && !$defs['initialized']) {
            $reflectionClass = new ReflectionClass($this);
            $annotationReader = new AnnotationReader();

            foreach ($reflectionClass->getProperties() as $prop) {
                if ($prop->isPublic()) {
                    $defs['props'][$prop->getName()] = [
                        'readable' => true,
                        'writable' => true,
                    ];
                } else {
                    try {
                        $annotation = $annotationReader->getPropertyAnnotation($prop, '\\Webpay\\Annotation\\Accessor');
                        if ($annotation instanceof AccessorAnnotation) {
                            $defs['props'][$prop->getName()] = [
                                'readable' => $annotation->isReadable(),
                                'writable' => $annotation->isWritable(),
                            ];
                        }
                    } catch (AnnotationException $e) {
                        $defs['props'][$prop->getName()] = [
                            'readable' => false,
                            'writable' => false,
                        ];
                    }
                }
            }

            $defs['initialized'] = true;
        }

        return isset($defs['props'][$name][$mode])
            ? $defs['props'][$name][$mode]
            : $default
        ;
    }
}
