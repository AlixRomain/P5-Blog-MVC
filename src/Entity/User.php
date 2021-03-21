<?php


namespace App\Entity;


use App\Controller\Globals\Hydrator;

class User
{
    use Hydrator;
    private $id_user;
    private $firstName;
    private $lastName;
    private $password;
    private $token;
    private $rgpd;
    private $dateRgpd;
    private $dateTokenExpire;
    private $devise;
    private $pseudo;
    private $email;
    private $rank;
    private $actif;

    public  function __construct(Array $datas){
        $this->hydrate($datas);
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * @return mixed
     */
    public function getRgpd()
    {
        return $this->rgpd;
    }

    /**
     * @param mixed $rgpd
     */
    public function setRgpd($rgpd): void
    {
        $this->rgpd = $rgpd;
    }

    /**
     * @return mixed
     */
    public function getDateRgpd()
    {
        return $this->dateRgpd;
    }

    /**
     * @param mixed $dateRgpd
     */
    public function setDateRgpd($dateRgpd): void
    {
        $this->dateRgpd = $dateRgpd;
    }

    /**
     * @return mixed
     */
    public function getDateTokenExpire()
    {
        return $this->dateTokenExpire;
    }

    /**
     * @param mixed $dateTokenExpire
     */
    public function setDateTokenExpire($dateTokenExpire): void
    {
        $this->dateTokenExpire = $dateTokenExpire;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * @param mixed $devise
     */
    public function setDevise($devise): void
    {
        $this->devise = $devise;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * @param mixed $rank
     */
    public function setRank($rank): void
    {
        $this->rank = $rank;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void
    {
        $this->actif = $actif;
    }
}
