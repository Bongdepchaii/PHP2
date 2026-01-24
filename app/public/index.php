<?php
// echo "Hello wworld! This iss index.php";
// require_once __DIR__ . '/../vendor/autoload.php';
require_once dirname(__DIR__) . '/core/bootstrap.php';
$router = new Router();
$router->dispatch($_SERVER["REQUEST_URI"]);


?>