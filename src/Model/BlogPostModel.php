<?php


namespace App\Model;


use PDO;

class BlogPostModel extends MasterModel
{
    /**
     * @param null $array
     * @return array
     *  Return all blogPost
     */
    public function fetchAllBlogpost($array = null)
    {
        /**
         * @return array
         */
        return $this->fetchAll('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            AND blogPost.actif = 1
            ORDER BY CASE WHEN blogpost.dateUpdate > blogpost.dateCreate
            THEN blogpost.dateUpdate ELSE blogpost.dateCreate END DESC
            ', $array);
    }
    /**
     * @param null $array
     * @return array
     * Return all blogPost with comments disable
     */
    public function fetchAllBlogPostWithCommentDisable($array = null)
    {
        /**
         * @return array
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
            ', $array);
    }
    /**
     * @param $id_blogPost
     * @return boolean
     * disable one blogPost that matches an id_blogPost
     */
    public function disableBlogPost($id_blogPost)
    {
        /**
         * @return boolean
         */
        $array = [[':id', $id_blogPost,PDO::PARAM_INT] ];
        return $this->fetchOne('
            UPDATE blogpost SET
            actif = 0
            WHERE blogpost.id_blogPost = :id',$array);
    }

    /**
     * @param $title
     * @return object
     * return blogPost that matches an title
     */
    public function fetchOneBlogPostByTitle( $title)
    {
        /**
         * @return object
         */
        $array = [[':title', $title,PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT title FROM blogpost
            WHERE blogpost.title = :title',$array);
    }

    /**
     * @param $id_blogpost
     * @return object
     * Return one blogPost  that matches an id_blogPost
     */
    public function fetchOneBlogPostById($id_blogpost)
    {
        /**
         * @return object
         */

        $array = [[':id', $id_blogpost, PDO::PARAM_INT] ];
        return $this->fetchOne('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            AND blogPost.actif = 1
            AND id_blogPost = :id',$array );
    }
    /**
     * @param $blogPost
     * @return boolean
     * insert one blogPost from one object
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
     * @param $blogPost
     * @param $id_blogPost
     * @return boolean
     * update one blogPost from one object that matches an id_blogPost
     */
    public function updateBlogPost($blogPost, $id_blogPost)
    {

        $req = 'UPDATE blogpost SET title = :title, chapo = :chapo, content = :content, dateUpdate = :dateUpdate WHERE blogpost.id_blogPost = :id';
        $blog =[
           'title'      => $blogPost->getTitle(),
            'chapo'     => $blogPost->getChapo(),
            'content'   => $blogPost->getContent(),
            'dateUpdate'=> $blogPost->getDateCreate(),
            'id'        => $id_blogPost
        ];
        return $this->execArray($req, $blog);
    }
}