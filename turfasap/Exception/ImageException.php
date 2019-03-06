<?php

namespace Turfasap\Exception;


class ImageException extends BaseException
{
    public static $STORE_ERROR = "store_error";
    public static $RETRIEVE_ERROR = "retrieve_error";

    public static function STORE_ERROR($args) {
        return self::getInstance(self::class, self::$STORE_ERROR, $args);
    }

    public static function RETRIEVE_ERROR($args) {
        return self::getInstance(self::class,self::$RETRIEVE_ERROR, $args);
    }

}