<?php


namespace App\Model;


class MasterModel
{
    /**
     * @param $req
     * @return mixed
     */
    public function fetch($req)
    {
        var_dump($req);
        try {
            $req = Connexion::getPDO()->prepare($req);
            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e){
            //rerouter? +afficher l'erreur
        }
        //$2y$10$xz5UVhVsgY.Xl.gbKMlX0O8Iqcl/3iMiH4wk7bJIaniDLtUsU6bRK
    }

    //Voir pour refactoriser avec dans le fetch. la requte qui finit par AND Article.idArticle = :id)
    //puis dans execute 'id'=> $id   $id etant deuxieme param de read.
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