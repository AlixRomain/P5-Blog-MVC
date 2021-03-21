<?php


namespace App\Controller\Globals;


     trait Hydrator{
     public function hydrate(array $array){
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }
}
