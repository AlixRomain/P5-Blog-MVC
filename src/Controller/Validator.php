<?php


namespace App\Controller;


use App\Controller\Globals\FieldValid;
use App\Controller\Globals\MasterController;

class Validator extends FieldValid
{
    /**
     *
     */
    public function blogPostValid(Array $datas)
    {
        $errors = [];
        foreach ($datas as $k => $v ){
           $fieldValid = $k.'Validator';
           $fieldValidvalid = $this->$fieldValid($v);
           if($fieldValidvalid !== true)
           array_push($errors,$fieldValidvalid);
        }
        return (empty($errors))?true:$errors;
    }

    /**
     *
     */
    public function newUserValid(Array $datas)
    {
        $errors = [];
        foreach ($datas as $k => $v ){
            $fieldValid = $k.'Validator';
            $fieldValidvalid = $this->$fieldValid($v);
            if($fieldValidvalid !== true)
                array_push($errors,$fieldValidvalid);
        }
        return (empty($errors))?true:$errors;
    }
}