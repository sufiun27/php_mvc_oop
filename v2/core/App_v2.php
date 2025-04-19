<?php
//print_r($_GET);
$scriptName = dirname($_SERVER['SCRIPT_NAME']);
$uri = str_replace($scriptName, '', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();

$router->get('/home/{id}/{name}', [HomeController::class, 'home']);

$router->middleware('test')
       ->get('/home/{id}', [HomeController::class, 'index']);

$router->dispatch($uri, $method);

show($router ->showUrl());