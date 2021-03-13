<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;
use App\Entity\BlogPost;
use App\Entity\Comment;

class BlogPostController extends MasterController
{
    /**
     *@var Template
     */
    const TwigAll = 'blogPosts.twig';
    /**
     *@var Template
     */
    const TwigOne = 'show.twig';
    /**
     *@var Template
     */
    const TwigCreate = 'createBlogPost.twig';

    /**
     * @param null $msg
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function allBlockPostMethod($msg = null)
    {
        $blogposts = $this->blogModel->fetchAllBlogpost();

        return $this->twig->render(self::TwigAll,
            ['blogPosts'=> $blogposts,
                'success'=> $msg
                ]);
    }
    /**
     *
     */
    public function showBlockPostMethod($msg = null, $id_blog = null)
    {
        (!isset($id_blogpost))?$id_blogpost = $this->get->getDataGet('idBlogPost') :$id_blogpost = $id_blog;

        if(!is_numeric($id_blogpost)){
            $this->redirect('home','defaultMethod');
        }
        $blogpost = $this->blogModel->fetchOneBlogPostById($id_blogpost);
        if($blogpost !== false){
            $comments =  $this->commentModel->fetchAllCommentByBlogpost($id_blogpost);
            return $this->twig->render(self::TwigOne,
                ['blogPost'=> $blogpost, 'comments'=> $comments, 'errors'=> $msg ]);
        }else{
            $this->redirect('home','defaultMethod');
        }
    }
    /**
     *
     */
    public function deleteBlogPostMethod()
    {
        $id_blogpost = $this->get->getDataGet('idBlogPost') ;
        if(!is_numeric($id_blogpost)){
            $this->redirect('home','defaultMethod');
        }
        $blogPost = $this->blogModel->fetchOneBlogPostById($id_blogpost);
        if($blogPost != false){
            $blogPost =  $this->blogModel->disableBlogPost($id_blogpost);
            ($blogPost !== false)? $error ='BlogPost supprimé avec succès':$error = 'Echec de la suppression du blogPost';
            return $this->allBlockPostMethod($error);
        }else{
            $this->redirect('home','defaultMethod');
        }

    }
    /**
     *
     */
    public function createBlogPostMethod()
    {
        $dataPost = $this->post->getArrayPost();
        if(!isset($dataPost) || empty($dataPost)){
            return $this->twig->render(self::TwigCreate);
        }else{

            //Si je rafraichit la page et que j'ai déjà ce post e nbase je reroute
            $exist = $this->blogModel->fetchOneBlogPostByTitle( $this->post->getDataClean($dataPost['title']));
            if ($exist !== false){
                $error= ['Il semblerait qu\'un BlogPost avec ce titre existe déjà en base.'];
                return $this->twig->render(self::TwigCreate,[
                    'errors'=> $error
                ]);
            }else{
                $cleanData = $this->validator->blogPostValid($dataPost);
                if($cleanData !== true){
                    return $this->twig->render(self::TwigCreate,[
                        'errors'=> $cleanData
                    ]);
                }else{
                    $dateCreate = date("Y-m-d H:i:s");
                    $dateUpdate = NULL;
                    $blogPost = new BlogPost([
                        'title' => $this->post->getDataClean($dataPost['title']),
                        'chapo' => $this->post->getDataClean($dataPost['chapo']),
                        'content' => $this->post->getDataClean($dataPost['content']),
                        'dateCreate'=> $dateCreate,
                        'dateUpdate'=> $dateUpdate,
                        'publish' => 1,
                        'actif' => 1,
                        'id_author' => 1
                    ]);

                    if($this->blogModel->createBlogPost($blogPost)){
                        $success = 'Le BlogPost à bien été publié, il est visible et les internanutes oeuvent le commenter';
                        return $this->allBlockPostMethod($success);
                    }
                }
            }
        }
    }

    /**
     *
     */
    public function updateBlogPostMethod()
    {
        $dataPost = $this->post->getArrayPost();
        if(!isset($dataPost) || empty($dataPost)){
            $id_blogpost = $this->get->getDataGet('idBlogPost');
            $validBlogPost = $this->blogModel->fetchOneBlogPostById($id_blogpost);
            if ($validBlogPost !== false){
                return $this->twig->render(self::TwigCreate,[
                    'blogPost'=> $validBlogPost,
                ]);
            }
        }else{
            $cleanData = $this->validator->blogPostValid($dataPost);
            $id_blogpost = $this->get->getDataGet('idBlogPost');
            $validBlogPost = $this->blogModel->fetchOneBlogPostById($id_blogpost);
            if($cleanData !== true){
                return $this->twig->render(self::TwigCreate,[
                    'errors'=> $cleanData,
                    'blogPost'=> $validBlogPost
                ]);
            }else{
                $dateUpdate = date("Y-m-d H:i:s");
                $newBlogPost = new BlogPost($validBlogPost);

                $newBlogPost->setTitle($this->post->getDataClean($dataPost['title']));
                $newBlogPost->setChapo($this->post->getDataClean($dataPost['chapo']));
                $newBlogPost->setContent($this->post->getDataClean($dataPost['content']));
                $newBlogPost->setDateUpdate($dateUpdate);

                if($this->blogModel->updateBlogPost($newBlogPost, $id_blogpost)){
                    $success = 'Modification effectué avec succès';
                    return $this->allBlockPostMethod($success);
                }
            }
        }
    }
    /**
     *
     */
    public function createCommentPost()
    {
        $dataPost = $this->post->getArrayPost();
        $id_blogpost = $this->get->getDataGet('idBlogPost');
        $validBlogPost = $this->blogModel->fetchOneBlogPostById($id_blogpost);

        if(!isset($dataPost) || empty($dataPost) || $validBlogPost == false ){
            $errors = 'Echec, votre commentaire n\'a pas été pris en compte par nos service.';
            return $this->allBlockPostMethod($errors);
        }else{
            //Si je rafraichit la page et que j'ai déjà ce post e nbase je reroute
            $exist = $this->commentModel->fetchOneCommentPostByContent($id_blogpost, $this->post->getDataClean($dataPost['comment']));
            if ($exist !== false ){
                $error= ['Votre commentaire est en attente de validation'];
                return $this->showBlockPostMethod($error, $id_blogpost);
            }else{
                $cleanData = $this->validator->blogPostValid($dataPost);
                if($cleanData !== true){
                    return $this->showBlockPostMethod($cleanData, $id_blogpost);
                }else{
                    $dateCreate = date("Y-m-d H:i:s");
                    $comment = new Comment([
                        'content' => $this->post->getDataClean($dataPost['comment']),
                        'dateCreate'=> $dateCreate,
                        'publish' => 0,
                        'actif' => 1,
                        'id_author' => 1,
                        'id_blogPost' => $id_blogpost
                    ]);
                    if($this->commentModel->createComment($comment)){
                        $success = 'Votre commentaire à bien été pris en compte. Il est en attente de validation.';
                        return $this->allBlockPostMethod($success);
                    }
                }
            }
        }
    }
    /**
     *
     */
    public function deleteCommentMethod()
    {
        $id_comment = $this->get->getDataGet('idComment') ;
        $id_blogpost = $this->get->getDataGet('idBlogPost') ;
        if(!is_numeric($id_comment) || !is_numeric($id_blogpost)){
            $this->redirect('home','defaultMethod');
        }
        $comment = $this->commentModel->fetchOneCommentById($id_blogpost, $id_comment);
        if($comment != false){
            $comment =  $this->commentModel->disableComment($id_comment);
            ($comment !== false)? $error =['Commentaire supprimé avec succès']:$error = ['Echec de la suppression du commentaire'];
            return $this->showBlockPostMethod($error, $id_blogpost);
        }else{
            $this->redirect('home','defaultMethod');
        }

    }


    /**
     *
     */
    public function publishCommentMethod()
    {
        $id_comment = $this->get->getDataGet('idComment') ;
        $id_blogpost = $this->get->getDataGet('idBlogPost') ;
        if(!is_numeric($id_comment) || !is_numeric($id_blogpost)){
            $this->redirect('home','defaultMethod');
        }
        $comment = $this->commentModel->fetchOneCommentById($id_blogpost, $id_comment);
        if($comment != false){
            $comment =  $this->commentModel->publishComment($id_comment);
            ($comment !== false)? $error =['Publication réussi']:$error = ['Echec de la publication du commentaire'];
            return $this->showBlockPostMethod($error, $id_blogpost);
        }else{
            $this->redirect('home','defaultMethod');
        }

    }

}