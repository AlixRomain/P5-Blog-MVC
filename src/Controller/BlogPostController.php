<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;
use App\Entity\BlogPost;

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
    public function showBlockPostMethod()
    {
        $id_blogpost = $this->get->getDataGet('idBlogPost');
        if(!is_numeric($id_blogpost)){
            $this->redirect('home','defaultMethod');
        }
        $blogpost = $this->blogModel->fetchOneBlogPostById($id_blogpost);
        if($blogpost != false){
            $comments =  $this->commentModel->fetchAllCommentByBlogpost($id_blogpost);
            return $this->twig->render(self::TwigOne,
                ['blogPost'=> $blogpost, 'comments'=> $comments ]);
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
                        'publish' => 0,
                        'actif' => 1,
                        'id_author' => 1
                    ]);

                    if($this->blogModel->createBlogPost($blogPost)){
                        $success = 'Le BlogPost à bien été pris en compte. Il est en attente de validation.';
                        return $this->allBlockPostMethod($success);
                    }
                }
            }
        }
    }

}