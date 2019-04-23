<?php 
require "../Config/dev.php";
require "../vendor/autoload.php";

$router = new \App\Config\Router();
$router->run();