<?php 

namespace App;

class Route
{
    private $path;
    private $action;
    private $controller;
    private $middlewares = [];
    private $params = [];
    private $matches = [];


    public function __construct($path, $controller)
    {
        $this->path = trim($path);
        $this->controller = $controller['controller'];
        $this->action = $controller['action'];
    }

    public function withMiddleware($middlewares)
    {
        $this->withMiddleware[] = ucfirst($middlewares);
    }

    public function withParam($param, $regex)
    {
        $this->param[$param] = str_replace('(', '(?:', $regex);
        return $this;
    }

    public function match($url)
    {
        $url = trim($url, '/');
        $path = preg_replace_callback('#:([\w]+)#', [$this, 'paramMatch'], $this->path);
        $regex = "#^$path$#i";

        if(!preg_match($regex, $url, $matches))
        {
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        
        return true;
    }

    public function paramMatch($match)
    {
        if(isset($this->params[$match[1]]))
        {
            return '('.$this->params[$match[1]];
        }
        
        return "([^/]+)";
    }

    public function call()
    {
        if(count($this->middlewares))
        {
            foreach ($this->middlewares as $middleware)
            {
                $middleware = 'Middlewares\\'.$middleware;
                $check = new $middleware();
                
                if(!$check)
                {
                    $errorController = new \Controllers\ErrorController;
                    $errorController->error403();
                }
            }
        }

        $controller = 'Controllers\\'.$this->controller;
        $controller = new $controller();

        if(method_exists($controller, $this->action))
        {
            return call_user_func_array([$controller, $this->action], $this->matches);
        }

        throw new Exception('Methode passée au controlleur n\'existe pas.'); 
    }
    
}