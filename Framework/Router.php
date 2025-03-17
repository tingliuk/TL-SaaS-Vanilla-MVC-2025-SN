<?php

namespace Framework;
use App\Controllers\ErrorController;  
use Framework\Middleware\Authorise;

class Router
{
    protected $routes = [];
    
    public function registerRoute($method, $uri, $action, $middleware = [])  
    {  
        list($controller, $controllerMethod) = explode('@', $action);  
      
        $this->routes[] = [  
            'method' => $method,  
            'uri' => $uri,  
            'controller' => $controller,  
            'controllerMethod' => $controllerMethod,  
            'Middleware' => $middleware  
        ];  
    }

    public function get($uri, $controller, $middleware = [])  
{  
    $this->registerRoute('GET', $uri, $controller, $middleware);  
}

public function post($uri, $controller, $middleware = [])  
{  
    $this->registerRoute('POST', $uri, $controller, $middleware);  
}

public function put($uri, $controller, $middleware = [])  
{  
    $this->registerRoute('PUT', $uri, $controller, $middleware);  
}

public function delete($uri, $controller, $middleware = [])  
{  
    $this->registerRoute('DELETE', $uri, $controller, $middleware);  
}

public function route($uri, $controller, $middleware = []):
{
    $requestMethod = $_SERVER['REQUEST_METHOD'];  
  
// Check for _method input  
if ($requestMethod === 'POST' && isset($_POST['_method'])) {  
    // Override the request method with the value of _method  
    $requestMethod = strtoupper($_POST['_method']);  
}
foreach ($this->routes as $route) {  
  
    $uriSegments = explode('/', trim($uri, '/'));  
  
    $routeSegments = explode('/', trim($route['uri'], '/'));  
  
    $match = true;
} 
if ($match) {  
    foreach ($route['Middleware'] as $middleware) {  
        (new Authorise())->handle($middleware);  
    }  
  
    $controller = 'App\\controllers\\' . $route['controller'];  
    $controllerMethod = $route['controllerMethod'];  
  
    // Instantiate the controller and call the method  
    $controllerInstance = new $controller();  
    $controllerInstance->$controllerMethod($params);  
    return;  
}
}
