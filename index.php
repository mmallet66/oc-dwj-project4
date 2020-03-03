<?php
require_once "controller/Autoloader.php";

Autoloader::register();

$router = new Router();
$router->traitment();