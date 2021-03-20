<?php


namespace App\Controller\Admin;


use App\Controller\Globals\MasterController;

class UserController extends MasterController
{
    /**
     * @return mixed
     */
    public function invalidToken($token)
    {
        $valid = $this->userModel->isExistToken($token);
        return($valid !== false)? true: false;
    }

}