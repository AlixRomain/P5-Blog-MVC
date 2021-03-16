<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;
use App\Entity\User;
use MongoDB\BSON\Timestamp;
use Twig\Token;

class LoginController extends MasterController
{

    public function loginMethod( $msg = null)
    {
        $idBlogPost = $this->get->getDataGet('idBlogPost');
        if(is_numeric($idBlogPost)){
            $errors = ['Vous devez être connecter pour commenter sur notre blog'];
            return $this->twig->render('Admin/login.twig',[
                'errors' => $errors
            ]);
        }
        $dataUser = $this->post->getArrayPost();
        var_dump($dataUser);
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
            return $this->twig->render('Admin/login.twig',[ 'success' => $msg]);
        }
    }

    public function createAccountMethod()
    {
        $dataUser = $this->post->getArrayPost();
        if(isset($dataUser) && !empty($dataUser)){
            //Je passe les datas au validator:
            $cleanData = $this->validator->newUserValid($dataUser);
            if($cleanData !== true){
                return $this->twig->render('Admin/createAccount.twig',['errors' => $cleanData, 'user' => $dataUser]);
            }else{
                //Est ce que j'ai déjà cette adresse mail en base || ce pseudo ?
                $existUser = $this->userModel->fetchOneUserByEmailOrPseudo($dataUser['email'],$dataUser['pseudo']);
                //Est ce que les deux pass sont identiques?
                $password = $this->session->validPassUser($dataUser['pass1'],$dataUser['pass2']);
                if($existUser !== false){
                    $error = ['Un compte avec cette adresse existe déja en base de donnée.'];
                    return $this->twig->render('Admin/createAccount.twig',['errors' => $error, 'user' => $dataUser]);
                }elseif(is_null($password)){
                    $error =['Les mots de passe saisies ne sont pas identiques'];
                    return $this->twig->render('Admin/createAccount.twig',['errors' => $error, 'user' => $dataUser]);
                }

                //j'hydrate l'objet et je l'insère en base
                $date 		= new \DateTime();
                $dateCreate = $date->format('Y-m-d H:i:s');

                $token 	= time().rand(1000000,9000000);

                $date->setTimestamp(strtotime("+15 minutes"));
                $date_token	= $date->format('Y-m-d H:i:s');

                $user = new User([
                    'firstName' => $this->post->getDataClean($dataUser['firstName']),
                    'lastName' => $this->post->getDataClean($dataUser['lastName']),
                    'email'=> $this->post->getDataClean($dataUser['email']),
                    'password' => password_hash($dataUser['pass1'], PASSWORD_DEFAULT),
                    'pseudo' => $this->post->getDataClean($dataUser['pseudo']),
                    'devise' => $this->post->getDataClean($dataUser['devise']),
                    'rank' => 'UTILISATEUR',
                    'actif' => 0,
                    'rgpd' => 1,
                    'dateRgpd' => $dateCreate,
                    'token' => $token,
                    'dateTokenExpire' => $date_token
                ]);

                if($this->userModel->createUser($user)){
                    $success = 'Votre inscription à bien été pris en compte. Pour la finaliser veuillez vous rendre sur votre boîte mail à fin de confirmer le lien que nous vous avons envoyé.';
                    return $this->twig->render('Admin/login.twig',[
                         'success' => $success
                    ]);
                }
                return 'loooser';
                //Si insertion Ok j'envoit enn email
            }

        }else{
            return $this->twig->render('Admin/createAccount.twig');
        }
    }

    public function registerMethod(){
        //index.php?page=login&method=registerMethod&token='16158822074289917'
        $token = $this->get->getDataGet('token');
        $tokenValid = $this->userModel->oneUserByTokenValid($token);

        if($tokenValid !== false){
            echo 'julie';
            $this->userModel->activAccount($token);
            $success = 'Votre compte est désormais valide. Veuillez entrer vos identifiants pour accéder à la plateforme.';
            return $this->twig->render('Admin/login.twig',[
                'success' => $success
            ]);
        }else{
            //Remodifié le token
            $newToken 	= time().rand(1000000,9000000);
            $this->userModel->setNewToken($token, $newToken);
            //Envoi d'un nouveau email.


            $errors = ['Vous avez dépassé le temps imparti pour activer votre compte. Nous vous avons envoyé un nouveau lien sur votre boîte mail. Vous avez de nouveau 15 min pour le valider.'];
            return $this->twig->render('Admin/login.twig',[
                'errors' => $errors,
                'NewToken'=> $token
            ]);
        }
    }


    public function logoutMethod()
    {
        $this->session->logoutSession();
        $this->redirect('home','defaultMethod');
    }

}