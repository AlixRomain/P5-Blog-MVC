<?php


namespace App;


class Router
{
    const DEFAULT_METHOD = 'DefaultMethod';

    public function __construct()
    {
        $this->getUrl();
        $this->setHomeController();
    }

    public function getUrl()
    {
        $page = filter_input(INPUT_GET, 'page');

        if (!isset($page) || is_numeric($page)) {
            $page = 'home';
        }
        $this->controller = ucfirst(strtolower($page));

        $method = filter_input(INPUT_GET, 'method');

        if (!isset($method) || is_numeric($method)) {
            $method = 'DefaultMethod';
        }
        $this->method = ucfirst($method);

    }

    public function setHomeController(){
        $this->controller = 'App\Controller\\' . $this->controller . 'Controller';
        if (!class_exists($this->controller)) {
            $this->controller = 'App\Controller\HomeController';
        }
        if (!method_exists($this->controller, $this->method)) {
            $this->method = self::DEFAULT_METHOD;
        }
        $this->controller = new $this->controller;

        $reponse = call_user_func([$this->controller, $this->method]);

        echo filter_var($reponse);
    }

}