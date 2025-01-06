<?php
require __DIR__ . '/vendor/autoload.php';
include_once 'src/Router.php'; 
use App\Router;

$request = $_SERVER['REQUEST_URI'];

if (str_contains($request, '.php')) {
    $request = str_replace('src', '', $request);
    $request = str_replace('/', '', $request);
    $request = str_replace('.php', '', $request);
    header('Location: '.$request);
    die();
}

$router = new Router();
print $router->resolveRequest($request);
