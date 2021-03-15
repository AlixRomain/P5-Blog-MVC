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
    /**
    * @return array
    */
    public function fetchOneUserByEmailOrPseudo($email, $pseudo)
    {
        $email = Connexion::getPDO()->quote($email);
        $pseudo = Connexion::getPDO()->quote($pseudo);
        /**
         * @return array
         * Retourne
         */

        return $this->fetch('
            SELECT * FROM user
            WHERE user.email = '.$email.'
            OR pseudo = '.$pseudo);
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
}
