<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/4
 * Time: 22:58
 */

namespace woo\controller;


class RegistryTest
{
    private static $instance;
    private static $testMode;
    private $value = array();

    private function __construct(){

    }

    //测试模式
    static function testMode($mode=true){
        self::$instance = null;
        self::$testMode = $mode;
    }

    //生产模式：实例
    static function instance(){
        //切换testMode
        if( self::$testMode )
            return new MockRegistry();
        //生成实例
        if( !isset(self::$instance) ){ self::$instance = new self(); }
        return self::$instance;
    }

    function get( $key ){
        return isset($this->value[$key]) ? $this->value[$key] : null;
    }

    function set( $key, $val ){
        $this->value[$key] = $val;
    }

    function treeBuilder(){
        if( !isset($this->treeBuilder) ){
            $this->treeBuilder = new TreeBuilder( $this->conf()->get('treedir') );
        }
        return $this->treeBuilder;
    }

    function conf(){
        if( !isset($this->conf) ){
            $this->conf = new Conf();
        }
        return $this->conf;
    }
}

/********用于测试的类**************/
//单例
class Request{}
//工厂
class TreeBuilder{}

class Conf{}

//测试模式
class MockRegistry{}

/********用于测试的类end**************/

$reg = Registry::instance();
$reg->set( 'tree', '树' );

$reg = Registry::instance();
echo '单例模式的注册表';
print_r( $reg->get('tree') );
echo "<br>";
echo '融入工厂模式的注册表';
var_dump($reg->treeBuilder());
echo "<br>";
Registry::testMode();
$mockreg = Registry::instance();
var_dump($mockreg);