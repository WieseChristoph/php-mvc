<?php

namespace App\Core;

use App\Controller\ErrorController;

enum HttpMethod: int
{
    case GET = 0;
    case POST = 1;

    /**
     * @throws \ValueError
     */
    public static function fromName(string $name): HttpMethod
    {
        foreach (self::cases() as $method) {
            if (strcasecmp($name, $method->name) === 0) {
                return $method;
            }
        }
        
        throw new \ValueError("$name is not a valid backing value for enum " . self::class);
    }
}

class Router
{
    private array $routes = [];

    public function get(string $path, $callback): static
    {
        $this->routes[HttpMethod::GET->value][$path] = $callback;

        return $this;
    }

    public function post(string $path, $callback): static
    {
        $this->routes[HttpMethod::POST->value][$path] = $callback;

        return $this;
    }

    public function resolve()
    {
        // Get request URL
        $path = $_SERVER['REQUEST_URI'] ?? '/';

        // Strip parameters from path
        $pos = strpos($path, '?') ?? false;
        if ($pos !== false) {
            $path = substr($path, 0, $pos);
        }

        // Get request method
        $method = HttpMethod::fromName($_SERVER['REQUEST_METHOD']);

        // Get corresponding callback
        $callback = $this->routes[$method->value][$path] ?? [ErrorController::class, "notFound"];

        // Instanciate class
        $callback[0] = new $callback[0];

        // Call callback
        echo call_user_func($callback);
    }
}