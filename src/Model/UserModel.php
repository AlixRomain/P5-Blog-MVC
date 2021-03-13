<?php


namespace App\Model;


class UserModel extends MasterModel
{
    /**
     * @return array
     */
    public function fetchOneUserByEmail($email)
    {
        $email = Connexion::getPDO()->quote($email);
        /**
         * @return array
         * Retourne
         */
        return $this->fetch('
            SELECT * FROM user
            WHERE actif = 1
            AND email = '.$email);
    }
}