<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 13:42
 */

namespace woo\base;


class ApplicationRegistry extends Registry
{
    private static $instance;
    private $freezedir = "data";
    private $values = array();
    private $mtimes = array();

    private function __construct(){

    }

    public static function instance(){
        if( !isset(self::$instance) ){ self::$instance = new self(); }
        return self::$instance;
    }

    protected function set($key, $val){
        $this->values[$key] = $val;
        $path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
        file_put_contents( $path, serialize( $val) );//产生一个可存储的值的表示
        $this->mtimes[$key] = time();
    }

    protected function get($key){
        $path = $this->freezedir. DIRECTORY_SEPARATOR . $key;
        if( file_exists($path) ){
            clearstatcache(); //清除缓存
            $mtime = filemtime( $path ); //返回文件上次修改时间
            if( !isset($this->mtimes[$key]) ){ $this->mtimes[$key] = 0; }
            if( $mtime > $this->mtimes[$key] ){
                $data = file_get_contents( $path );
                $this->mtimes[$key] = $mtime;
                return ( $this->values[$key]=unserialize($data) );
            }
        }
        if( isset($this->values[$key]) ){
            return $this->values[$key];
        }
        return null;
    }

    static function getDSN(){
        return self::instance()->get('dsn');
    }

    static function setDSN( $dsn ){
        return self::instance()->set( 'dsn', $dsn );
    }
}