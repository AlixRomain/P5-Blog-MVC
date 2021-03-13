<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;

class LoginController extends MasterController
{

    public function loginMethod()
    {
        $idBlogPost = $this->get->getDataGet('idBlogPost');
        if(is_numeric($idBlogPost)){
            $errors = ['Vous devez être connecter pour commenter sur notre blog'];
            return $this->twig->render('Admin/login.twig',[
                'errors' => $errors
            ]);
        }
        $dataUser = $this->post->getArrayPost();
        if(isset($dataUser) && !empty($dataUser)){
            $email = $dataUser['email'];
            $password = $dataUser['pass'];
            $validUser = $this->userModel->fetchOneUserByEmail($email);
            if (password_verify($password, $validUser['password'])){
                $this->session->createSession($validUser);
                $this->redirect('blogPost','allBlockPostMethod');
            }else{
                $errors = ['Les identifiants ne sont pas valides.'];
                return $this->twig->render('Admin/login.twig',[
                    'errors' => $errors
                ]);
            }
        }else{
            return $this->twig->render('Admin/login.twig');
        }
    }

    public function logoutMethod()
    {
        $this->session->logoutSession();
        $this->redirect('home','defaultMethod');
    }

}