<?php


namespace App\Model;


use PDO;

class MasterModel
{

    /**
     * @param $req
     * @return mixed
     */
    public function fetchOne($req, $array)
    {
        try {
            $req = Connexion::getPDO()->prepare($req);
            foreach ($array as $k=> $val){
                $req->bindValue($val[0], $val[1], $val[2]);
            }
            $req->execute();
            return $req->fetch();

        } catch (\PDOException $e){
        }
    }
    /**
     * @param $req
     * @return mixed
     */
    public function execOne($req, $array)
    {
        try {
            $req = Connexion::getPDO()->prepare($req);
            foreach ($array as $k=> $val){
                $req->bindValue($val[0], $val[1], $val[2]);
            }
            $req->execute();
            return $req->rowCount();
        } catch (\PDOException $e){
        }
    }

    /**
     * @param $req
     * @return array
     */
    public function fetchAll($req, $array)
    {

        $req = Connexion::getPDO()->prepare($req);
        if(!is_null($array)){
            foreach ($array as $k=> $val) {
                $req->bindValue($val[0], $val[1], $val[2]);
            }
        }
        $req->execute();
        return $req->fetchAll();
    }

    /**
     * @param $req
     * @param array $array
     * @return bool|\PDOStatement
     */
    public function execArray($req, $array = [] )
    {
        $req = Connexion::getPDO()->prepare($req);
        return $req->execute($array);
    }
}
