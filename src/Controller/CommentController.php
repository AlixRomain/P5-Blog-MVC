<?php


namespace App\Controller;

use App\Controller\Globals\MasterController;
use App\Entity\BlogPost;
use App\Entity\Comment;
class CommentController extends MasterController
{
    /**
     *@var Template
     */
    const TwigAllComment = 'comments.twig';

    /**
     * @param null $msg
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function allCommentDisableMethod($msg = null)
    {

        $blogPosts = $this->blogModel->fetchAllBlogPostWithCommentDisable();
        $onePostForComments=[];
        foreach ($blogPosts as $blogPost){
            $comments = $this->commentModel->fetchAllCommentDisable($blogPost['id_blogPost']);
            array_push($onePostForComments,[$blogPost,$comments]);
        }
        return $this->twig->render(self::TwigAllComment,
            ['comments'=> $onePostForComments,
                'success'=> $msg
            ]);
    }

}