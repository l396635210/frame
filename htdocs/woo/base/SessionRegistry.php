<?php
namespace woo\base;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 13:31
 */


class SessionRegistry extends Registry
{
    private static $instance;
    private function __construct(){
        session_start();
    }

    static function instance(){
        if( !isset(self::$instance) ) self::$instance = new self();
        return self::$instance;
    }

    protected function get($key){
        return isset( $_SESSION[__CLASS__][$key] ) ? $_SESSION[__CLASS__][$key] : null;
    }

    protected function set($key, $val){
        $_SESSION[__CLASS__][$key] = $val;
    }

    function setComplex( Complex $complex ){
        self::instance()->set( 'complex', $complex );
    }

    function getComplex(){
        return self::instance()->get('complex');
    }
}