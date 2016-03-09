<?php

namespace woo\controller;

use woo\base\ApplicationRegistry;

class ApplicationHelper{
    private static $instance;
    private $config = "/tmp/data/woo_options.xml";

    private function __construct(){
    }

    static function instance(){
        if(!isset(self::$instance)){ self::$instance = new self(); }
        return self::$instance;
    }

    function init(){
        $dsn = ApplicationRegistry::getDSN();
        if( !is_null($dsn) ){
            return;
        }
        $this->getOptions();
    }

    function getOptions(){
        if( ! file_exists( $this->config ) ){
            $this->ensure($this->config, "Could not find options file" );
        }
        $options = simplexml_load_file( $this->config );
        print_r( get_class( $options) );
        $dsn = (string)$options->dsn();
        $this->ensure( $dsn, "No DSN found" );
        ApplicationRegistry::setDSN( $dsn );
        //设置其他值
    }

    private function ensure( $expr, $message ){
        if( !$expr ){
            throw new AppException( $message );
        }
    }
}

