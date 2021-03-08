<?php
namespace App\Controller;

use App\Controller\Globals\GetController;
use App\Controller\Globals\PostController;

/**
 * Class ImportController
 */
class ImportController
{
    /**
     * @var PostController
     */
    protected $post;

    /**
     * @var GetController
     */
    protected $get;

    /**
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->post = new PostController();
        $this->get = new GetController();

    }
}