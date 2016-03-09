<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/8
 * Time: 21:43
 */

namespace woo\command;


abstract class Command
{
    final function __construct(){

    }

    function execute( \woo\controller\Request $request ){
        $this->doExecute( $request );
    }

    abstract function doExecute( \woo\controller\Request $request );
}