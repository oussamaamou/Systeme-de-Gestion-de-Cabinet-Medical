<?php

use Core\Router;

Router::add("/", "AuthController", "index");
Router::add("/login", "AuthController", "login");
Router::add("/inscription", "AuthController", "register");
