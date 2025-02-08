<?php
namespace Core;

class Router
{
    private $routes = [];

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        // echo $uri;
        $path = explode('/',$uri,5);
        // var_dump($path[4]);
        $newPath = '/'.$path[4];
        // echo $newPath;
        if (isset($this->routes[$method][$newPath])) {
            $controllerAction = explode('@', $this->routes[$method][$newPath]);
            // echo '<pre>';
            // var_dump($this->routes[$method][$newPath]);
            // echo '</pre>';
            $controllerName = 'App\\Controllers\\' . $controllerAction[0];
            $action = $controllerAction[1];

            $controller = new $controllerName;
            $controller->$action();
        } else {
            http_response_code(404);
            echo "404 Not Found";
        }
    }
}
?>