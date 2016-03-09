<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 13:08
 */

namespace woo\base;


abstract class Registry{
    abstract protected function get( $key );
    abstract protected function set( $key, $val );

/*
    abstract public static function isEmpty();
    abstract public static function isPopulated();
    abstract public static function clear();
*/
}