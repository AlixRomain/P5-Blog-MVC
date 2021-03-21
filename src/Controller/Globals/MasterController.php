<?php

namespace App\Controller\Globals;

use App\Controller\ImportController;
use Twig\Environment;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

abstract class MasterController extends ImportController
{
    /**
     * @var Environment|null
     */
    protected $twig = null;
    /**
     * Constructor of MasterController
     * This role is to build a template twig
     */
    public function __construct()
    {
        parent::__construct();

        $this->twig = new Environment(new FilesystemLoader('../src/View'), array(
            'cache' => false,
            'debug' => true,
        ));
        //permet de Dumper depuis le front
        $this->twig->addExtension(new DebugExtension());
        //création super global session à partir de l'objet user récupérer
        $this->twig->addGlobal('session', $this->session->getUserSession());
    }

    /**
     * @param string $page
     * @param null $param
     */
    public function redirect(string $page, $param = null)
    {
        header('Location: index.php?page=' . $page . '&method=' . $param);
        exit();
    }
}

