<?php
namespace woo\base;//命名空间
/********************引入类start*************************/
require_once('../controller/Request.php');
/********************引入类end***************************/

/********************使用空间类start*************************/
use woo\controller\Request;
/********************使用空间类end*************************/

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 13:14
 */


class RequestRegistry extends Registry{
    private $values = array();
    private static $instance;

    private function __construct(){

    }

    public static function instance(){

        if( !isset(self::$instance) ) self::$instance = new self();

        return self::$instance;
    }

    protected function set( $key, $val ){
        $this->values[$key] = $val;
    }

    protected function get($key){
        return isset($this->values[$key]) ? $this->values[$key] : null;
    }

    static function getRequest(){
        return self::instance()->get('request');
    }

    static function setRequest( Request $request ){
        return self::instance()->set('request', $request);
    }

}

