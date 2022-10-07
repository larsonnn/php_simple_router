<?php
require_once "../vendor/autoload.php";
require "../Router.php";

$router = new Router(
    dirname(__FILE__) . "/routes.json",
    dirname(__FILE__) . "/controller"
);

$router->run();
