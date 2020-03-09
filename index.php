<?php
require_once "Autoloader.php";

Autoloader::register();

$router = new Router();
$router->traitment();