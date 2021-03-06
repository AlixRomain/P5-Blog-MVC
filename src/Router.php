<?php


namespace App;


class Router
{
    public function __construct()
    {
        $this->getUrl();
    }

    public function getUrl()
    {
        $page = filter_input(INPUT_GET, 'page');
        var_dump($page);
        if (!isset($page)) {
            $page = 'home';
        }
        $this->controller = $page;

        $method = filter_input(INPUT_GET, 'method');
        var_dump($method);
        if (!isset($method)) {
            $method = 'DefaultMethod';
        }
        $this->method = $method;
    }

}