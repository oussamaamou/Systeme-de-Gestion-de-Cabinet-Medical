<?php

namespace Core;

class Router {
    private static $routes = [];

    public static function add($uri, $controller, $method) {
        self::$routes[$uri] = ['controller' => $controller, 'method' => $method];
    }

    public static function dispatch($uri) {
        if (array_key_exists($uri, self::$routes)) {
            $controller = "app\\controllers\\" . self::$routes[$uri]['controller'];
            $method = self::$routes[$uri]['method'];

            if (class_exists($controller) && method_exists($controller, $method)) {
                $controllerInstance = new $controller();
                call_user_func([$controllerInstance, $method]);
            } else {
                echo "Erreur 404 : Page non trouvée.";
            }
        } else {
            echo "Erreur 404 : Page non trouvée.";
        }
    }
}
