<?php
namespace App\Controller;

use App\Controller\Globals\GetController;
use App\Controller\Globals\MailerController;
use App\Controller\Globals\PostController;
use App\Controller\Globals\SessionController;
use App\Model\BlogPostModel;
use App\Model\CommentModel;
use App\Model\UserModel;

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
     * @var SessionController
     */
    protected $session;
    /**
     * @var CommentModel;

     */
    protected $commentModel;
    /**
     * @var BlogPostModel;

     */
    protected $blogModel;
    /**
     * @var Validator;
     */
    protected $validator;
    /**
     * @var UserModel;
     */
    protected $userModel;
    /**
     * @var MailerController;
     */
    protected $mailer;

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
        $this->userModel = new UserModel;
        $this->session = new SessionController();
        $this->mailer = new MailerController();
    }
}