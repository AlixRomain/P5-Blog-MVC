<?php


namespace App\Model;


class MasterModel
{
    /**
     * @param $statement
     * @return mixed
     */
    public function fetch($statement)
    {
        try {
            $req = Connexion::getPDO()->prepare($statement);
            $req->execute();
            return $req->fetch();
        } catch (\PDOException $e){
            //rerouter? +afficher l'erreur
        }

    }
    //Voir pour refactoriser avec dans le fetch. le statement qui finit par AND Article.idArticle = :id)
    //puis dans execute 'id'=> $id   $id etant deuxieme param de read.
    /**
     * @param $statement
     * @return array
     */
    public function fetchAll($statement)
    {
        $req = Connexion::getPDO()->prepare($statement);
        $req->execute();
        return $req->fetchAll();
    }

}