<?php

//print_r($_SERVER);
//print_r($_GET);

//print_r(__DIR__);

function urlArrayShow($urlArray)
{
    echo "<pre>";
    print_r($urlArray);
    echo "</pre>";
}

//urlArrayShow($_GET);

// function splitUrl(){
//     global $URL; // Make the $URL variable available inside this function
//     $urlArray = explode("/", trim($URL));
//     return $urlArray;
// }

// $urlArray = splitUrl();

// print_r($urlArray);

class App
{
    public string $url;
    private string $controllerName = 'HomeController';
    private string $methodName = 'index';
    private object $controllerInstance;

    

    public function __construct()
    {
        $this->url = $_GET['url'] ?? 'home';
    }

    public function urlArrayShow(){
        $urlArray = $this->splitUrl();
        echo "<pre>";
        print_r($urlArray);
        echo "</pre>";
    }

    private function splitUrl(): array
    {
        return explode("/", trim($this->url));
    }

    public function loadController(): void
    {
        $urlArray = $this->splitUrl();
        $controllerBase = ucfirst($urlArray[0]);
        $this->controllerName = $controllerBase . 'Controller';
        $filename = "../app/controllers/" . $this->controllerName . ".php";

        if (file_exists($filename)) {
            require_once $filename;
            $this->controllerInstance = new $this->controllerName();
        } else {
            exit("Controller file '$filename' not found.");
        }
    }

    public function setMethod(): void
    {
        $urlArray = $this->splitUrl();
        if (!empty($urlArray[1]) && method_exists($this->controllerInstance, $urlArray[1])) {
            $this->methodName = $urlArray[1];
        }
    }

    public function callMethod(): void
    {
        echo "<br> <hr>";
        print_r($this->controllerName);
        print_r($this->methodName);
        call_user_func([$this->controllerInstance, $this->methodName]);
        echo "<br> <hr>";
    }
}

// Initialize and run
$app = new App();
$app->loadController();
$app->setMethod();
$app->callMethod();
$app->urlArrayShow();

//show($app->url);


// Use isset() to check if a variable is declared and not null.
        // Use !empty() to check if a variable has a non-empty, non-falsy value.
        // Note: empty() returns true for values like 0, '0', '', null, false, and [].