<?php


namespace App\Model;


class BlogPostModel extends MasterModel
{
    /**
     * @return array
     */
    public function fetchAllBlogpost()
    {
        /**
         * @return array
         * Retourne
         */
        return $this->fetchAll('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            AND blogPost.actif = 1
            ORDER BY CASE WHEN blogpost.dateUpdate > blogpost.dateCreate
            THEN blogpost.dateUpdate ELSE blogpost.dateCreate END DESC
            ');
    }

    /**
     * @return array
     */
    public function fetchOneBlogPostByTitle( $title)
    {
        /**
         * @return array
         * Retourne
         */
        $title = Connexion::getPDO()->quote($title);
        return $this->fetch('
            SELECT title FROM blogpost
            WHERE blogpost.title ='.$title);
    }

    /**
     * @return array
     */
    public function fetchOneBlogpostById($id_blogpost)
    {
        /**
         * @return array
         * Retourne
         */
        return $this->fetch('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            AND blogPost.actif = 1
            AND id_blogPost = '. $id_blogpost );
    }
    /**
     * @return array
     */
    public function createBlogPost($blogPost)
    {
        $req = 'INSERT INTO blogpost (title, chapo, content, dateCreate, dateUpdate, publish, actif, id_author) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $blog = [
            $blogPost->getTitle(),
            $blogPost->getChapo(),
            $blogPost->getContent(),
            $blogPost->getDateCreate(),
            $blogPost->getDateUpdate(),
            $blogPost->getPublish(),
            $blogPost->getActif(),
            $blogPost->getIdAuthor()
    ];

         return $this->execArray($req, $blog);
    }


}