<?php
class DATABASE_CONFIG {

    var $production = array(
        'driver' => 'mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 't4r5zjj',
        'database' => 'jrest',
        'prefix' => '',
    );

    var $developer = array(
        'driver' => 'mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => 't4r5zjj',
        'database' => 'jrest',
        'prefix' => '',
    );

    var $use;
    var $default;

    function __construct() {

        //Production
        if($_SERVER['HTTP_HOST']!='localhost' &&
           $_SERVER['HTTP_HOST']!='192.168.0.18') {
            $this->default = $this->production;

        //Developer
        } else {
            $this->default = $this->developer;
        }

        $this->use = $this->default;
    }
}