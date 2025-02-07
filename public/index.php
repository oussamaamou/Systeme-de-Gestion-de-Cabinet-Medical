<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/routes.php';

use Core\Router;

$uri = $_SERVER['REQUEST_URI'];
Router::dispatch($uri);
