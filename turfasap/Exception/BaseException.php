<?php

namespace Turfasap\Exception;


use Exception;

class BaseException extends Exception
{
    private $state;
    public function __construct($errors)
    {
        $this->message = $errors;
    }

    public function getErrors()
    {
        return $this->message;
    }

    protected function setState($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }

    protected static function getInstance($class, $state, $args) {
        $instance = new $class($args);
        $instance->setState($state);
        return $instance;
    }
}