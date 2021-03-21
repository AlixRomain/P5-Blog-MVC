<?php


namespace App\Controller;


use App\Controller\Globals\MasterController;
use App\Entity\User;

class LoginController extends MasterController
{
    /**
     *@var Template
     */
    const TWIG_LOGIN = 'Admin/login.twig';

    public function loginMethod( $msg = null)
    {
        $idBlogPost = $this->get->getDataGet('idBlogPost');
        if(is_numeric($idBlogPost)){
            $errors = ['Vous devez être connecter pour commenter sur notre blog'];
            return $this->twig->render(self::TWIG_LOGIN,[
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

                $this->redirect('home');
            }else{
                $errors = ['Les identifiants ne sont pas valides.'];
                return $this->twig->render(self::TWIG_LOGIN,[
                    'errors' => $errors
                ]);
            }
        }else{
            return $this->twig->render(self::TWIG_LOGIN,[ 'success' => $msg]);
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
                    //Si insertion Ok j'envoit enn email
                    $mailOk =  $this->mailer->sendCreateAccountEmail($user);
                    if($mailOk !== 1){
                        $errors = ['Nous rencontrons un problème pour vous envoyer votre lien d\'activation, merci de réessayer dans un petit moment.'];
                        return $this->twig->render(self::TWIG_LOGIN,['success' => $errors] );
                    }else{
                        $success = 'Votre inscription à bien été pris en compte. Un lien d\'activation vient de vous être envoyé sur votre messagerie "'.$user->getEmail().'" vous avez à présent 15 min pour vous authentifier.';
                        return $this->twig->render(self::TWIG_LOGIN,['success' => $success] );
                    }
                }
            }

        }else{
            return $this->twig->render('Admin/createAccount.twig');
        }
    }

    public function registerMethod(){
        //index.php?page=login&method=registerMethod&token='16158822074289917'
        $token = $this->get->getDataGet('token');
        $user = $this->userModel->fetchOneUserByToken($token);
        if($user !== false){
            $tokenValid = $this->userModel->oneUserByTokenValid($token);
            if($tokenValid !== false){
                $this->userModel->activAccount($token);
                $success = 'Votre compte est désormais valide. Veuillez entrer vos identifiants pour accéder à la plateforme.';
                return $this->twig->render('Admin/login.twig',[
                    'success' => $success
                ]);
            }else{
                //Remodifié le token

                $user= new User($user);
                $newToken 	= time().rand(1000000,9000000);
                $date = new \DateTime();
                $date->setTimestamp(strtotime("+15 minutes"));
                $newDateExpi = $date->format('Y-m-d H:i:s');
                $user->setToken($newToken);
                $user->setDateTokenExpire($newDateExpi);
                $this->userModel->setNewTokenAndDateExpi($user);
                //Envoi d'un nouveau email.
                $mailOk =  $this->mailer->sendCreateAccountEmail($user);
                if($mailOk !== 1){
                    $errors = ['Nous rencontrons un problème pour vous envoyer votre lien d\'activation, merci de réessayer dans un petit moment.'];
                    return $this->twig->render(self::TWIG_LOGIN,['success' => $errors] );
                }else{
                    $errors = ['Vous avez dépassé le temps imparti pour activer votre compte. Nous vous avons envoyé un nouveau lien sur votre boîte mail. Vous avez de nouveau 15 min pour le valider.'];
                    return $this->twig->render('Admin/login.twig',[
                        'errors' => $errors,
                        'NewToken'=> $token
                    ]);
                }
            }
        }
        $errors = ['Nous avons rencontré une erreur, veuillez réessayer de vous connecter ultérieurement','Code ERROR : Jeton Token introuvable en base'];

        return $this->twig->render('Admin/login.twig',[
            'errors' => $errors,
            'NewToken'=> $token
        ]);

    }
    public function passForgetMethod(){

        $dataUser = $this->post->getArrayPost();
        if(isset($dataUser) && !empty($dataUser)) {
            //Je passe les datas au validator:
            $cleanData = $this->validator->newUserValid($dataUser);
            if ($cleanData !== true) {
                return $this->twig->render('Admin/createAccount.twig', ['errors' => $cleanData, 'user' => $dataUser]);
            }else{
                $userConfirm = $this->userModel->fetchOneUserByEmail($dataUser['email']);
               if($userConfirm !== false){
                   //Remodifié le token et sa date d'expiration
                   $user = new User($userConfirm);
                   $newToken 	= time().rand(1000000,9000000);
                   $date = new \DateTime();
                   $date->setTimestamp(strtotime("+15 minutes"));
                   $newDateExpi = $date->format('Y-m-d H:i:s');
                   $user->setToken($newToken);
                   $user->setDateTokenExpire($newDateExpi);
                   $this->userModel->setNewTokenAndDateExpi($user);
                   //Envoi d'un nouveau email.
                   $mailOk =  $this->mailer->sendNewLinkActivation($user);
                   if($mailOk !== 1){
                       $errors = ['Nous rencontrons un problème pour vous envoyer votre lien d\'activation, merci de réessayer dans un petit moment.'];
                       return $this->twig->render(self::TWIG_LOGIN,['success' => $errors] );
                   }else{
                       $success = 'Nous venons de vous envoyer un nouveau liens d\'activation, vous avez à présent 15 min pour réinitialiser votre mot de passe';
                       return $this->twig->render('Admin/login.twig',[
                           'success' => $success
                       ]);
                   }
                   //j'envoie le mail

               }else{
                   $errors = ['Nous n\'avons pas de compte avec cette adresse mail chez nous, veuillez vous inscrire.'];
                   return $this->twig->render('Admin/createAccount.twig',[
                       'errors' => $errors
                   ]);
               }
            }
        }
        return $this->twig->render('Admin/forget.twig',[
            'errors' => '',
            'success'=> ''
        ]);
    }

    public function newPassMethod(){
        $dataPost = $this->post->getArrayPost();
        if(!isset($dataPost)){
            $dataget = $this->get->getArrayGet();
            //trouve moi un user avec cette id et ce token dont la date d'expiration n'a pas dépassé
            $userOk = $this->userModel->oneUserByTokenValidAndIdUser($dataget['idUser'],$dataget['token']);
            if($userOk){
                return $this->twig->render('Admin/newPassAccount.twig',[
                    'user' => $userOk
                ]);
            }else{
                $errors = 'Trop lent...Vous avez dépasser le temps imparti, veuillez renouveler votre demande.';
                return $this->twig->render('Admin/forget.twig',[
                    'errors' => $errors
                ]);
            }
        }else{
            $dataget = $this->get->getArrayGet();
            $cleanData = $this->validator->newUserValid($dataPost);
            //Est ce que les deux pass sont identiques?
            $password = $this->session->validPassUser($dataPost['pass1'],$dataPost['pass2']);
            if($cleanData !== true || is_null($password)){
                return $this->twig->render('Admin/newPassAccount.twig',['errors' => $cleanData]);
            }else {

                    $pass = password_hash($dataPost['pass1'], PASSWORD_DEFAULT);
                    $this->userModel->updatePassWord($dataget['idUser'], $pass );
                return $this->twig->render(self::TWIG_LOGIN,['success' => 'Veuillez vous connecter avec vos nouveaux identifiants']);
            }
        }
    }


    public function logoutMethod()
    {
        $this->session->logoutSession();
        $this->redirect('home','defaultMethod');
    }

}