<?php

declare(strict_types=1);

namespace App\Routing;

use App\Controllers\Controller;
use App\Controllers\Home;
use App\Controllers\Reset;

class Router
{
    private static string $path;

    private static ?Router $router = null;

    public array $routes = [
        '/' => Home::class,
        '/home' => Home::class,
        '/reset' => Reset::class,
        '/404' => Home::class,
    ];

    private function __construct()
    {
        self::$path = $_SERVER['PATH_INFO'] ?? '/';
    }

    public static function getFromGlobals(): self
    {
        if (null === self::$router) {
            self::$router = new self();
        }

        return self::$router;
    }

    public function getController(): Controller
    {
        $controllerClass = $this->routes[self::$path] ?? $this->routes['/404'];
        $controller = new $controllerClass();

        if (!$controller instanceof Controller) {
            throw new \LogicException("controller $controllerClass should implement".Controller::class);
        }

        return $controller;
    }
}
