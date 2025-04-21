<?php

/**
 * Application Bootstrap File
 * Defines the loading order and initializes the application
 *
 * @package Application
 */

// Exit if accessed directly
if (!defined('ROOT')) {
    http_response_code(403);
    exit('Direct access forbidden');
}

// Autoloader configuration
spl_autoload_register(
    function ($classname) {
    // Normalize class name to prevent path traversal
    $classname = str_replace(['\\', '/'], '', $classname);
    
    $paths = [
        ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . $classname . '.php',
      //  ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $classname . '.php',
      //  ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . $classname . '.php',
    ];

    foreach ($paths as $path) {
        // Verify path is within application directory
        $realPath = realpath($path);
        if ($realPath !== false && file_exists($realPath)) {
            require_once $realPath;
            return true;
        }
    }
    
    return false;
}, true, true);


require 'Session.php';
require 'FlashSession.php';
require 'Router.php';
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App_v2.php';
