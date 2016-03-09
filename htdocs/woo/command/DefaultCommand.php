<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/8
 * Time: 22:27
 */

namespace woo\command;
use woo\controller\Request;

require_once "../base/Registry.php";
require_once "../controller/Request.php";
require_once "./Command.php";

class DefaultCommand extends Command
{
    function doExecute(\woo\controller\Request $request){
        $request->addFeedback( "Welcome to WOO");
        include( "../view/main.php" );
    }
}

$defaultCommand = new DefaultCommand();
$defaultCommand->doExecute(new Request());