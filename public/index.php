<?php

session_start();

require_once dirname(__DIR__) . "/vendor/autoload.php";

use App\Core\Router;
use App\Controller\PostController;

$router = new Router();

$router
    ->get("/", [PostController::class, "index"])
    ->post("/", [PostController::class, "post"]);

$router->resolve();