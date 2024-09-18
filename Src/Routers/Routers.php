<?php

namespace Src\Routers;
use CoffeeCode\Router\Router;

class Routers 
{
    private string $dominio;

    public function __construct()
    {
       $this->dominio = routerConfig();
    }

    private function server()
    {
        $router = new Router("{$this->dominio}");
        return $router;
    }

    public function get()
    { 
       $router = $this->server();
       $router->group(null)->namespace("Src\Controller");
       $router->get("/", "IndexController:index");
       $router->get("/formulario","IndexController:form");
       $router->get("/resultado/{id}","IndexController:resultado");
       $router->get("/test","IndexController:test");
       $router->dispatch();
    }

    public function post()
    {
        $router = $this->server();
        $router->group(null)->namespace("Src\POST");
        $router->post("/form","Form:Result");
        $router->dispatch();
    }

}