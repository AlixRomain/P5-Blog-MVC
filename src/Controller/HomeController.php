<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;

/**
 * Class HomeController
 */
class HomeController extends MasterController
{
    public function defaultMethod()
    {
        return $this->twig->render('home.twig');
    }

    public function AboutMethod()
    {
        return $this->twig->render('about.twig');
    }
}