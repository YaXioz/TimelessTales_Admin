<?php
class Router
{
    private $routes = [];

    public function addRoute($url, $controller, $method)
    {
        $this->routes[$url] = ['controller' => $controller, 'method' => $method];
    }

    public function route($url)
    {
        $url = trim($url, '/');
        $parts = explode('/', $url);

        if (empty($parts[0])) {
            $parts[0] = 'dashboard';
        }

        $routeKey = $parts[0];
        if (isset($this->routes[$routeKey])) {
            $controller = $this->routes[$routeKey]['controller'];
            $method = $this->routes[$routeKey]['method'];

            $params = array_slice($parts, 1);

            return ['controller' => $controller, 'method' => $method, 'params' => $params];
        }

        return false;
    }
}
