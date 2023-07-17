<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

require 'config.php';
require 'helper/Auth.php';

// load libs
function myAutoloader($class) {
    //echo $class.'<hr>';
    require LIBS . $class . '.php';
}
spl_autoload_register('myAutoloader');

// Load MF!
$mf = new MF();

// Optional Path Settings
//$bootstrap->setControllerPath();
//$bootstrap->setModelPath();
//$bootstrap->setDefaultFile();
//$bootstrap->setErrorFile();

$mf->init();