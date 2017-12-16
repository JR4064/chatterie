<?php

// URL
define('ROOT', 'http://' . $_SERVER['SERVER_NAME'] . str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

define('IMAGES', 'www/img');
define('CONTROLLER', 'application/controllers');

// database
define('DB_NAME', 'chatterie');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');



// mode debug
define('DEBUG_MODE', true);


if (DEBUG_MODE == false) {
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);
    error_reporting(0);
}


// permet d'inclure automatiquement les classes et models lors de leur instanciation

spl_autoload_register(function ($className) {
    if (substr($className, -5) == "Model")
        include "application/models/".$className.".php";
    else
        include "application/class/".$className.".class.php";
});





session_start();