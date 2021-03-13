<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;

class LoginController extends MasterController
{

    public function loginMethod()
    {
        $dataUser = $this->post->getArrayPost();
        if(isset($dataUser) && !empty($dataUser)){
            $email = $dataUser['email'];
            $password = $dataUser['pass'];
            $validUser = $this->userModel->fetchOneUserByEmail($email);
            if (password_verify($password, $validUser['password'])){
                $this->session->createSession($validUser);
                $this->redirect('home','defaultMethod');
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