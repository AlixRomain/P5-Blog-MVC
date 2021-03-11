<?php
namespace App\Controller;

use App\Controller\Globals\GetController;
use App\Controller\Globals\PostController;
use App\Model\BlogPostModel;
use App\Model\CommentModel;

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
     * @var CommentModel;

     */
    protected $commentModel;
    /**
     * @var BlogPostModel;

     */
    protected $blogModel;
    /**
     * @var ValidatorController;

     */
    protected $validator;

    /**
     * ImportController constructor.
     */
    public function __construct()
    {
        $this->post = new PostController();
        $this->get = new GetController();
        $this->blogModel = new BlogPostModel();
        $this->commentModel = new CommentModel();
        $this->validator = new Validator();
    }
}