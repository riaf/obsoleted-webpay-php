<?php

namespace Webpay;

use Guzzle\Service\Command\ResponseClassInterface;
use Guzzle\Service\Command\OperationCommand;

abstract class AbstractObject implements ResponseClassInterface
{
    public static function fromCommand(OperationCommand $command)
    {
        $response = $command->getResponse();
        $data = $response->json();

        $obj = new static();
        $ref = new \ReflectionClass($obj);

        foreach ($data as $key => $val) {
            // "hoge_fuga" => "hogeFuga"
            $key = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));

            try {
                $prop = $ref->getProperty($key);
                $prop->setAccessible(true);
                $prop->setValue($obj, $val);
            } catch (\ReflectionException $e) {
                // Unknown parameters
                // public で set する？
            }
        }

        return $obj;
    }
}
