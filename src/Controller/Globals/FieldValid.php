<?php


namespace App\Controller\Globals;


class FieldValid
{
    public function titleValidator($title){
        $error = "Le titre doit faire au moins 5 caractères";
      return  (empty($title) || strlen(trim($title)) <= 5)?$error: true;
    }
    public function chapoValidator($chapo){
        $error = "Le chapo est obligatoire.";
        return  (empty($chapo))?$error: true;
    }
    public function contentValidator($content){
        $error = "Veuillez insérer votre contenu.";
        return (empty($content) )?$error: true;
    }
    public function commentValidator($comment){
        $error = "Veuillez insérer un commentaire.";
        return (empty($comment) )?$error: true;
    }
    public function firstNameValidator($firstName){
        $error = "Le prénom n'est pas valide pour cette plateforme";
        return (empty($firstName) || strlen(trim($firstName)) <= 2 || is_numeric($firstName))?$error: true;
    }
    public function lastNameValidator($lastName){
        $error = "Le nom n'est pas valide pour cette plateforme";
        return (empty($lastName) || strlen(trim($lastName)) <= 2 || is_numeric($lastName))?$error: true;
    }
    public function pseudoValidator($pseudo){
        $error = "Le pseudo est trop court pour la plateforme";
        return (empty($pseudo) || strlen(trim($pseudo)) <= 2)?$error: true;
    }
    public function emailValidator($email){
        $error = "Veuillez saisir une adresse email valide";
        return (!filter_var($email,FILTER_VALIDATE_EMAIL))?$error: true;
    }
    public function deviseValidator($devise){
        return ( $devise === $devise )? true: true;
    }
    public function rgpdValidator($rgpd){
        $error = "Vous devez accepter les termes du site pour vous créer un compte";
        return ($rgpd !== 'on')?$error: true;
    }

    public function pass1Validator($pass){
        $error = "Votre Mots de passe doit comporter au moins 6 caractères dont un minuscule, un majuscule, un chiffre et un caractère spécial";
        return (
            !preg_match("/[a-z]+/",$pass) ||
            strlen($pass) < 6 ||
            !preg_match("/[A-Z]+/",$pass) ||
            !preg_match("/[0-9]+/",$pass) ||
            !preg_match("/\W+/",$pass)
            )?$error: true;
    }
    public function pass2Validator($pass){
        return ($pass === $pass)?true: true;
    }

}