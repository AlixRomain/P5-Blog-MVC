<?php

namespace App\Controller\Globals;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class MasterController
{
    /**
     * @var Environment|null
     */
    protected $twig = null;
    /**
     * Constructor of MasterController
     * This role is to buil a template twig
     */
    public function __construct()
    {
        $this->twig = new Environment(new FilesystemLoader('../src/View'), array(
            'cache' => false,
            'debug' => true,
        ));

    }

    /**
     * @param string $page
     * @param null $param
     */
    public function redirect(string $page, $param = null)
    {
        header('Location: index.php?page=' . $page . '&' . $param);
        exit;
    }

}
