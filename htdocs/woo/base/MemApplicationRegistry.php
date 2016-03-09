<?php
namespace woo\base;
require_once('./woo/base/Registry.php');

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 14:29
 */

class MemApplicationRegistry extends Registry{
    private static $instance;
    private $values = array();
    private $id;
    const DSN = 1;

    private function __construct(){
        $this->id = @shm_attach(55, 10000, 0600);//内存共享
        if( !$this->id ){ throw new \Exception("could not access shared memory"); }
    }

    static function instance(){
        if( !isset(self::$instance) ){ self::$instance = new self(); }
        return self::$instance;
    }

    protected function set($key, $val){
        return shm_put_var($this->id, $key, $val);//加入或更新内存空间中的变量。
    }

    protected function get($key){
        return shm_get_var( $this->id, $key );
    }

    static function setDSN( $dsn ){
        return self::instance()->set(self::DSN, $dsn );
    }

    static function getDSN(){
        return self::instance()->get( self::DSN );
    }
}