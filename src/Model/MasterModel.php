<?php


namespace App\Model;


use PDO;

class MasterModel
{
    /**
     * @param $req
     * @return mixed
     */
    public function fetch($req)
    {
        try {
            $req = Connexion::getPDO()->prepare($req);
            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e){
            //rerouter? +afficher l'erreur
        }
    }

    /**
     * @param $req
     * @return mixed
     */
    public function fetchByBind($req, $drap, $value, $pdo)
    {
        try {
            $req = Connexion::getPDO()->prepare($req);
            $req->bindValue($drap, $value, $pdo);
            var_dump($value);

            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e){
            //rerouter? +afficher l'erreur
        }
    }

    /**
     * @param $req
     * @return array
     */
    public function fetchAll($req)
    {

        $req = Connexion::getPDO()->prepare($req);
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * @param $req
     * @param array $array
     * @return bool|\PDOStatement
     */
    public function execArray($req, $array = [])
    {

        $req = Connexion::getPDO()->prepare($req);
        return $req->execute($array);
    }

}