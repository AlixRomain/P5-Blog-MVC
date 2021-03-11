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
}