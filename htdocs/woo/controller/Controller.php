<?php
namespace woo\controller;

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/5
 * Time: 15:05
 */


class Controller
{
    private $applicationHelper;

    private function __construct(){

    }

    //run()快捷方式构造controller并调用init()和handleRequest()
    static function run(){
        $instance = new Controller();
        $instance->init();
        $instance->handleRequest();
    }

    /**
     * init()方法获得ApplicationHelper（应用程序助手）类的一个实例。
     * 这个类的作用是管理应用程序配置信息。
     * 控制器的init()方法调用ApplicationHelper中同名init()方法，
     * 用于初始化应用程序要使用的数据。
     */
    function init(){
        $applicationHelper = ApplicationHelper::instance();
        $applicationHelper->init();
    }

    /**
     * handleRequest()方法通过CommandResolver（命令分离器）来获取一个
     * Command对象，然后调用execute()方法。
     */
    function handleRequest(){
        $request = new Request();
        $cmd_r = new \woo\command\CommandResolver();
        $cmd = $cmd_r->getCommand( $request );
        $cmd->execute( $request );
    }
}