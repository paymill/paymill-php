<?php

/**
 * Define path to application directory
 */
defined('APPLICATION_PATH') || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../lib/'));
spl_autoload_extensions(".php");
spl_autoload_register(function($class) {
        $class = str_replace("\\", "/", $class);
        if (file_exists(APPLICATION_PATH . DIRECTORY_SEPARATOR . $class . '.php')) {
            /** @noinspection PhpIncludeInspection */
            /** @noinspection PhpIncludeInspection */
            require_once(APPLICATION_PATH . DIRECTORY_SEPARATOR . $class . '.php');
            }
        }
);
