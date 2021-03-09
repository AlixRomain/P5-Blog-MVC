<?php
namespace App\Controller;

use App\Controller\Globals\GetController;
use App\Controller\Globals\PostController;
use App\Model\BlogPostModel;

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
     * @var BlogPostModel;

     */
    protected $blogModel;

    /**
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->post = new PostController();
        $this->get = new GetController();
        $this->blogModel = new BlogPostModel();
    }
}