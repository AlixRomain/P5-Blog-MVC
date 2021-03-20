<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;

/**
 * Class HomeController
 */
class HomeController extends MasterController
{
    /**
     *@var Template
     */
    const TwigHome = 'home.twig';
    /**
     *@var Template
     */
    const TwigAbout = 'about.twig';

    public function defaultMethod()
    {
        $number = 0;
        if($this->session->validAdmin()){
           $number = count($this->commentModel->fetchAllCommentDisableByIdUser($_SESSION['user']['id_user']));
        }
        return $this->twig->render(self::TwigHome,['number' => $number]);
    }

    public function AboutMethod()
    {
        return $this->twig->render(self::TwigAbout);
    }
    public function contactMethod()
    {
        $dataPost = $this->post->getArrayPost();
        if(!isset($dataPost) || empty($dataPost)){
            return $this->twig->render(self::TwigHome);
        }else {
            $cleanData = $this->validator->blogPostValid($dataPost);
            if($cleanData !== true){
                return $this->twig->render(self::TwigHome,[
                    'errors'=> $cleanData
                ]);
            }else{

               $mailOk =  $this->mailer->sendContactEmail($dataPost);
               if($mailOk !== 1){
                   $errors = ['Échec de l\'envoie de votre message, merci de réessayer dans un petit moment.'];
                   return $this->twig->render(self::TwigHome,['success' => $errors] );
               }else{
                   $success = 'Je vous remercie de l\'attention que vous porter à mon blog, je ne manquerais pas de vous répondre dé que possible.';
                   return $this->twig->render(self::TwigHome,['success' => $success] );
               }
            }
        }
    }
}