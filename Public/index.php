<?php

declare(strict_types=1);

use App\Routing\Router;

session_start();

require_once('../Config/vars.php');

spl_autoload_register(function ($fqcn) {
    $path = str_replace('\\', '/', $fqcn);
    require_once(__DIR__ . '/../' . $path . '.php');
});

$router = Router::getFromGlobals();
$controller = $router->getController();

\App\Helpers\View::render('header');
$controller->render();
\App\Helpers\View::render('footer');

