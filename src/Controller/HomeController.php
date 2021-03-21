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
    const TWIG_HOME = 'home.twig';
    /**
     *@var Template
     */
    const TWIG_ABOUT = 'about.twig';

    public function defaultMethod()
    {
        $number = 0;
        if($this->session->validAdmin()){
           $number = count($this->commentModel->fetchAllCommentDisableByIdUser($_SESSION['user']['id_user']));
        }
        return $this->twig->render(self::TWIG_HOME,['number' => $number]);
    }

    public function AboutMethod()
    {
        return $this->twig->render(self::TWIG_ABOUT);
    }
    public function contactMethod()
    {
        $dataPost = $this->post->getArrayPost();
        if(!isset($dataPost) || empty($dataPost)){
            return $this->twig->render(self::TWIG_HOME);
        }else {
            $cleanData = $this->validator->blogPostValid($dataPost);
            if($cleanData !== true){
                return $this->twig->render(self::TWIG_HOME,[
                    'errors'=> $cleanData
                ]);
            }else{

               $mailOk =  $this->mailer->sendContactEmail($dataPost);
               if($mailOk !== 1){
                   $errors = ['Échec de l\'envoie de votre message, merci de réessayer dans un petit moment.'];
                   return $this->twig->render(self::TWIG_HOME,['success' => $errors] );
               }else{
                   $success = 'Je vous remercie de l\'attention que vous porter à mon blog, je ne manquerais pas de vous répondre dé que possible.';
                   return $this->twig->render(self::TWIG_HOME,['success' => $success] );
               }
            }
        }
    }
}