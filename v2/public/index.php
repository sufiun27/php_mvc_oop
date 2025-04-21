<?php

define('ROOT', dirname(__DIR__));
//ENVIRONMENT
define('ENVIRONMENT', 'development'); // Set to 'production' in production environment
//echo ROOT . "<br>";
define('BASE_URL', 'http://localhost/php_mvc_oop/v2/public');

require ROOT . DIRECTORY_SEPARATOR."core".DIRECTORY_SEPARATOR."init.php";
