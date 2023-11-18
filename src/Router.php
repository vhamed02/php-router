<?php

class Router
{
    private $routes = [];

    public function add(string $method, string $path, Closure $callable)
    {
        $this->routes[$method][$path] = $callable;
    }

    public function match()
    {
        $method = strtolower($_SERVER['REQUEST_METHOD']);
        $url = strtolower($_SERVER['REQUEST_URI']);
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $routeUrl => $target) {
                $pattern = preg_replace('/\/:([^\/]+)/', '/(?P<$1>[^/]+)', $routeUrl);
                if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
                    $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                    call_user_func_array($target, $params);
                    return;
                }
            }
        }
        throw new Exception('Route not found!');
    }
}