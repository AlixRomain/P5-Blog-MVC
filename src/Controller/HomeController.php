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
        $blogposts = $this->blogModel->fetchAllArticle();

        return $this->twig->render('home.twig',
        ['blogPosts'=> $blogposts]);
    }
}