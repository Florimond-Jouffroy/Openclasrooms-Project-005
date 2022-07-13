<?php 


require '../vendor/autoload.php';


use App\{Router, Session, Request};

Session::start();

$request = new Request();
$dotenv = \Dotenv\Dotenv::create('../');
$dotenv->load();

$action = $request->getAction() ?? '';


$router = new Router($action);
require_once '../routes/routes.php';


$router->run();
