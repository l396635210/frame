<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/6
 * Time: 7:56
 */

namespace woo\command;


class CommandResolver
{
    private static $base_cmd;
    private static $default_cmd;

    function __construct(){
        if( ! self::$default_cmd ){
            self::$base_cmd = new \ReflectionClass( "\woo\command\Command" );
            self::$default_cmd = new DefalutCommand();
        }
    }

    function getCommand( \woo\controller\Request $request ){
        $cmd = $request->getProperty( 'cmd' );
        $sep = DIRECTORY_SEPARATOR;

        if( !cmd ){
            return self::$default_cmd;
        }

        $cmd = str_replace( array(".", $sep), "", $cmd );
        $filepath = "woo{$sep}{$cmd}.php";
        $classname = "woo\\command\\{$cmd}";
        if( file_exists($filepath) ){
            @require_once("$filepath");
            if( class_exists($classname) ){
                $cmd_class = new ReflectionClass( $classname );
                if( $cmd_class->isSubClassOf( self::$base_cmd ) ){
                    return $cmd_class->newInstance();
                }else{
                    $request->addFeedback( "command '$cmd' is not a Command" );
                }
            }
        }

        $request->addFeedback( "command '$cmd' not found" );
        return clone self::$default_cmd;
    }
}