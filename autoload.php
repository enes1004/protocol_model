<?php

//Our autoloader function.
function autoloader($className){
    $className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    $className = str_replace("ProtocolModel/", "", $className);
  	include_once __DIR__ . '/lib/' . $className . '.php';
}

//Tell PHP what our autoloading function is.
spl_autoload_register('autoloader');
