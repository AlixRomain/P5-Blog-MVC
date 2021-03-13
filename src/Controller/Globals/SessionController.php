<?php


namespace App\Controller\Globals;


use App\Entity\User;

class SessionController
{
    private $session;

    private $user;

    public function __construct(){
        //$this->session = filter_var_array($_SESSION);

        if(isset($_SESSION['user'])){
            $this->session = $_SESSION['user'];
            $this->user = $_SESSION['user'];
        }
    }
    public function createSession($validUser)
    {
        $_SESSION['user'] = [
            'id_user' => $validUser['id_user'],
            'firstName' => $validUser['firstName'],
            'lastName' => $validUser['lastName'],
            'pseudo' => $validUser['pseudo'],
            'devise' => $validUser['devise'],
            'email' => $validUser['email'],
            'rank' => $validUser['rank']
        ];
    }

    public function logoutSession(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            session_destroy();
        }
    }
    /**
     * @return mixed
     */
    public function getUserSession()
    {
        return $this->user;
    }

}