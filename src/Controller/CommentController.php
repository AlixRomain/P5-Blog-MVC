<?php


namespace App\Controller;

use App\Controller\Globals\MasterController;
use App\Entity\BlogPost;
use App\Entity\Comment;
class CommentController extends MasterController
{

    private $adminOk;
    private $userOk;
    /**
     * Constructor of CommentController
     * This role is to verify the rank of user
     */
    public function __construct()
    {
        parent::__construct();
        $this->adminOk = $this->session->validAdmin();
        $this->userOk = $this->session->validUser();
    }
    /**
     *
     *@var Template
     */
    const TWIG_ALL_COMMENT = 'blogPost/comments.twig';

    /**
     * @param null $msg
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function allCommentDisableMethod($msg = null)
    {
        if(is_null($this->adminOk)){
            $this->redirect('home','defaultMethod');
        }else{
            $blogPosts = $this->blogModel->fetchAllBlogPostWithCommentDisable();
            $onePostForComments=[];
            foreach ($blogPosts as $blogPost){
                $comments = $this->commentModel->fetchAllCommentDisable($blogPost['id_blogPost']);
                array_push($onePostForComments,[$blogPost,$comments]);
            }
            return $this->twig->render(self::TWIG_ALL_COMMENT,
                ['comments'=> $onePostForComments,
                    'success'=> $msg
                ]);
        }
    }

    /**
     *
     */
    public function publishCommentMethod()
    {
        $id_comment = $this->get->getDataGet('idComment') ;
        $id_blogpost = $this->get->getDataGet('idBlogPost') ;
        if(!is_numeric($id_comment) || !is_numeric($id_blogpost) || is_null($this->adminOk)){
            $this->redirect('home','defaultMethod');
        }
        $comment = $this->commentModel->fetchOneCommentById($id_blogpost, $id_comment);

        if($comment !== false){
            $comment =  $this->commentModel->publishComment($id_comment);
            ($comment !== false)? $error ='Publication réussi':$error = 'Echec de la publication du commentaire';
            return $this->allCommentDisableMethod($error);
        }else{
            $this->redirect('home','defaultMethod');
        }
    }

}
