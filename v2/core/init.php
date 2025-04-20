<?php

spl_autoload_register(function($classname){

	require $filename = "../app/models/".ucfirst($classname).".php";
});


require 'Router.php';
require 'config.php';
require 'functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App_v2.php';
