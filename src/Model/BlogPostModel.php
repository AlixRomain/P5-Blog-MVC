<?php


namespace App\Model;


use PDO;

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
    public function fetchAllBlogPostWithCommentDisable()
    {
        /**
         * @return array
         * Retourne
         */
        return $this->fetchAll('
            SELECT * FROM blogpost
            INNER JOIN comment 
            ON comment.id_blogPost = blogpost.id_blogPost
            WHERE comment.publish = 0
            AND comment.actif = 1
            GROUP BY blogpost.id_blogPost
            ORDER BY CASE WHEN blogpost.dateUpdate > blogpost.dateCreate
            THEN blogpost.dateUpdate ELSE blogpost.dateCreate END DESC
            ');
    }
    /**
     * @return array
     */
    public function disableBlogPost($id_blogPost)
    {
        /**
         * @return array
         * Retourne
         */
        $drap = ':id';
        $pdo = PDO::PARAM_INT;
        return $this->fetchByBind('
            UPDATE blogpost SET
            actif = 0
            WHERE blogpost.id_blogPost = :id',$drap, $id_blogPost,  $pdo);
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
        $drap = ':title';
        $pdo = PDO::PARAM_STR;
        return $this->fetchByBind('
            SELECT title FROM blogpost
            WHERE blogpost.title = :title',$drap,$title,$pdo);
    }

    /**
     * @return array
     */
    public function fetchOneBlogPostById($id_blogpost)
    {
        /**
         * @return array
         * Retourne
         */
        $drap = ':id';
        $pdo = PDO::PARAM_INT;
        return $this->fetchByBind('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            AND blogPost.actif = 1
            AND id_blogPost = :id',$drap, $id_blogpost,$pdo );
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
    /**
     * @return array
     */
    public function updateBlogPost($blogPost, $id_blogPost)
    {
        $req = 'UPDATE blogpost SET title = :title, chapo = :chapo, content = :content, dateUpdate = :dateUpdate WHERE blogpost.id_blogPost =' .$id_blogPost;
        $blog =[
           'title'      => $blogPost->getTitle(),
            'chapo'     => $blogPost->getChapo(),
            'content'   => $blogPost->getContent(),
            'dateUpdate'=> $blogPost->getDateCreate()
        ];
        return $this->execArray($req, $blog);
    }


}