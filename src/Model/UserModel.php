<?php


namespace App\Model;


use PDO;

class UserModel extends MasterModel
{
    /**
     * @return array
     */
    public function fetchOneUserByEmail($email)
    {

        /**
         * @return array
         * Retourne
         */
        $array = [[':email', $email, PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT * FROM user
            WHERE actif = 1
            AND email = :email', $array);
    }
    /**
    * @return array
    */
    public function fetchOneUserByEmailOrPseudo($email, $pseudo)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':email', $email, PDO::PARAM_STR], [':pseudo', $pseudo, PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT * FROM user
            WHERE user.email = :email
            OR pseudo = :pseudo', $array);
    }

    /**
     * @return array
     */
    public function createUser($user)
    {
        $req = 'INSERT INTO user (firstName, lastName, email, password, pseudo, devise, rank, rgpd, dateRgpd, token, dateTokenExpire, actif) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?)';
        $user = [
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getPseudo(),
            $user->getDevise(),
            $user->getRank(),
            $user->getRgpd(),
            $user->getDateRgpd(),
            $user->getToken(),
            $user->getDateTokenExpire(),
            $user->getActif()
        ];

        return $this->execArray($req, $user);
    }

    /**
     * @return array
     */
    public function setNewTokenAndDateExpi($user)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':id', $user->getIdUser(), PDO::PARAM_INT], [':token', $user->getToken(), PDO::PARAM_INT], [':date', $user->getDateTokenExpire(), PDO::PARAM_STR] ];
        return $this->fetchOne('
            UPDATE  user SET
            token = :token,
            dateTokenExpire = :date
            WHERE user.id_user = :id', $array);
    }
    /**
     * @return array
     */
    public function activAccount($token)
    {

        /**
         * @return array
         * Retourne
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            UPDATE  user SET
            actif = 1
            WHERE user.token = :token', $array);
    }

    /**
     * @return array
     */
    public function oneUserByTokenValid($token)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE token = :token 
            AND dateTokenExpire >= NOW()',$array);
    }
    /**
     * @return array
     */
    public function oneUserByTokenValidAndIdUser($id_user, $token)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':id', $id_user, PDO::PARAM_INT], [':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE id_user = :id
             AND token = :token 
             AND dateTokenExpire >= NOW()', $array);
    }
    /**
     * @return array
     */
    public function updatePassWord($id_user, $pass)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':id', $id_user, PDO::PARAM_INT], [':pass', $pass, PDO::PARAM_STR]];
        return $this->fetchOne('
            UPDATE  user SET
            password = :pass
            WHERE id_user = :id', $array);
    }
    /**
     * @return array
     */
    public function fetchOneUserByToken($token)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE token = :token', $array);
    }
    /**
     * @return array
     */
    public function isExistToken($token)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE token = :token', $array);
    }
}
