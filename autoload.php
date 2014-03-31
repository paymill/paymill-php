<?php

function autoload($className)
{
    $className = ltrim($className, "\\");
    $fileName  = '';
    $namespace = '';
    if ($lastNsPos = strripos($className, "\\")) {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace("\\", DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require 'lib/'.$fileName;
}

spl_autoload_register('autoload');
