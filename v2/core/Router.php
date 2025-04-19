<?php

class Router
{
    private $routes = [];
    private $mname;

    public function get($uri, $action)
    {
        $this->add('GET', $uri, $action);
    }

    public function post($uri, $action)
    {
        $this->add('POST', $uri, $action);
    }

    public function add($method, $uriPattern, $action)
    {
        $pattern = preg_replace('#\{([^}]+)\}#', '(?P<\1>[^/]+)', $uriPattern);
        $pattern = "#^" . $pattern . "$#";

        $this->routes[$method][] = [
            'pattern' => $pattern,
            'action' => $action,
            'middleware' => $this->mname
        ];

        // Reset middleware after adding route
        $this->mname = null;
    }

    // Fixed spelling and allows chaining
    public function middleware($mname)
    {
        $this->mname = $mname;
        return $this;
    }

    public function showUrl()
    {
        return $this->routes;
    }

    public function dispatch($uri, $method)
    {
        $method = strtoupper($method);

        foreach ($this->routes[$method] ?? [] as $route) {
            if (preg_match($route['pattern'], $uri, $matches)) {
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                $action = $route['action'];

                // Run middleware if exists
                if (!empty($route['middleware'])) {
                    $middlewareName = ucfirst($route['middleware']);
                    $middlewarePath = ROOT . DIRECTORY_SEPARATOR . "App" . DIRECTORY_SEPARATOR . "Middleware" . DIRECTORY_SEPARATOR . $middlewareName . ".php";
                    $middlewareClass = "App\\Middleware\\$middlewareName";
                    
                    if (file_exists($middlewarePath)) {
                        require_once $middlewarePath;
                    }

                    if (class_exists($middlewareClass)) {
                        $middlewareInstance = new $middlewareClass;

                        if (method_exists($middlewareInstance, 'handle')) {
                            $result = $middlewareInstance->handle();

                            if ($result === false) {
                                echo "Request blocked by middleware: {$middlewareName}";
                                return;
                            }
                        }
                    } else {
                        echo "Middleware not found: {$middlewareClass}";
                        return;
                    }
                }

                // Call controller or callable
                if (is_array($action)) {
                    [$controller, $controllerMethod] = $action;
                    require_once ROOT . "/app/controllers/" . basename(str_replace('\\', '/', $controller)) . ".php";
                    $controllerInstance = new $controller;
                    return $controllerInstance->$controllerMethod($params);
                }

                if (is_callable($action)) {
                    return call_user_func_array($action, $params);
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}
