<?php


namespace App\Model;


use PDO;

class Connexion
{
    /**
     * Stores the Connection
     * @var null
     */
    private static $pdo = null;

    /**
     * Returns the Connection if it exists or creates it before returning it
     * @return PDO|null
     */
    public static function getPDO()
    {
        require_once '../config/database.php';
        if (self::$pdo === null) {
            self::$pdo = new PDO(DB_DSN, DB_USER, DB_PASS, DB_OPTIONS);
            self::$pdo->exec('SET NAMES UTF8');
        }
        return self::$pdo;
    }
    //DSN data sourne name est le chemin vers la Bdd. 'mysql:dbName='nom_bdd';host=127.0.0.1;
    //PDO::PREPARE prépare une requete à l'exzcution et retourne un obkjet

    //PDO::EXEC envoit une requête d'appel d'une fonction, retourne le nombre de ligne affecté
    //Util pour INSERT/UPDATE/DELETE

    //PDO::QUERY retourne un jeu de résultat en tant qu'objet PDO::STATEMENT | return False en cas d'erreur
    //util pour les SELECT. $query = $pdo->query('SELECT * FROM posts);
    //$query est devenu un PDO::STATEMENT et bénéficie de toute ces méthodes.
    //$allPost = $query->fetchAll(); pour tous les resultat. Voir option possibilité de récupérer tableau associatif
    //$onePost = $query->fetch(); pour un resultat
    //onecolonne = $query->fetchColumn(num); pour toute une colonne
    //$id = $pdo->quote($_GET['id']); Pour sécuriser un id récupérer en Url

}