<?php


namespace App\Model;


use PDO;

class UserModel extends MasterModel
{
    /**
     * @param $email
     * @return object
     * return one user that matches an email
     */
    public function fetchOneUserByEmail($email)
    {

        /**
         * @return object
         */
        $array = [[':email', $email, PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT * FROM user
            WHERE actif = 1
            AND email = :email', $array);
    }
    /**
     * @param $email
     * @param $pseudo
     * @return object
     * return one user that matches an email or pseudo
    */
    public function fetchOneUserByEmailOrPseudo($email, $pseudo)
    {
        /**
         * @return object
         */
        $array = [[':email', $email, PDO::PARAM_STR], [':pseudo', $pseudo, PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT * FROM user
            WHERE user.email = :email
            OR pseudo = :pseudo', $array);
    }

    /**
     * @param $user
     * @return boolean
     * insert one user from an object
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
     * @param $user
     * @return boolean
     * update one token of one user
     */
    public function setNewTokenAndDateExpi($user)
    {
        /**
         * @return boolean
         */
        $array = [[':id', $user->getIdUser(), PDO::PARAM_INT], [':token', $user->getToken(), PDO::PARAM_INT], [':date', $user->getDateTokenExpire(), PDO::PARAM_STR] ];
        return $this->fetchOne('
            UPDATE  user SET
            token = :token,
            dateTokenExpire = :date
            WHERE user.id_user = :id', $array);
    }
    /**
     * @param $token
     * @return boolean
     * updtate a field actif from user table a matches an token
     */
    public function activAccount($token)
    {

        /**
         * @return boolean
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            UPDATE  user SET
            actif = 1
            WHERE user.token = :token', $array);
    }

    /**
     * @param $token
     * @return object
     * return one user that matches an token
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
     * @param $token
     * @param $id_user
     * @return object
     * return one user that matches an id and token valid
     */
    public function oneUserByTokenValidAndIdUser($id_user, $token)
    {
        /**
         * @return object
         */
        $array = [[':id', $id_user, PDO::PARAM_INT], [':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE id_user = :id
             AND token = :token 
             AND dateTokenExpire >= NOW()', $array);
    }
    /**
     * @param $id_user
     * @param $pass
     * @return boolean
     * update one password of user
     */
    public function updatePassWord($id_user, $pass)
    {
        /**
         * @return boolean
         */
        $array = [[':id', $id_user, PDO::PARAM_INT], [':pass', $pass, PDO::PARAM_STR]];
        return $this->fetchOne('
            UPDATE  user SET
            password = :pass
            WHERE id_user = :id', $array);
    }
    /**
     * @param $token
     * @return object
     * return one user that matches an token
     */
    public function fetchOneUserByToken($token)
    {
        /**
         * @return object
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE token = :token', $array);
    }
    /**
     * @param $token
     * @return boolean
     * return a boolean valid if a param matches an token in user table
     */
    public function isExistToken($token)
    {
        /**
         * @return boolean
         */
        $array = [[':token', $token, PDO::PARAM_INT]];
        return $this->fetchOne('
            SELECT * FROM user 
             WHERE token = :token', $array);
    }
}
