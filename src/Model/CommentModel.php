<?php


namespace App\Model;


use PDO;

class CommentModel extends MasterModel
{
    /**
     * @param $id_blogpost
     * @return array
     * Return all comments from one blogPost
     */
    public function fetchAllCommentByBlogpost($id_blogpost)
    {
        /**
         * @return array
         */
        $array = [[':id', $id_blogpost, PDO::PARAM_INT]];
        return $this->fetchAll('
            SELECT * FROM comment
            INNER JOIN user 
            ON user.id_user = comment.id_author
            WHERE comment.publish = 1
            AND comment.actif = 1
            AND comment.id_blogpost = :id
            ORDER BY comment.dateCreate DESC
            ', $array);

    }
    /**
     * @param $content
     * @param $id_BlogPost
     * @return object
     * Returns one comment that matches a content
     */
    public function fetchOneCommentPostByContent($id_BlogPost, $content)
    {
        /**
         * @return array
         */
        $array = [[':id', $id_BlogPost,PDO::PARAM_INT], [':content', $content, PDO::PARAM_STR] ];
        return $this->fetchOne('
            SELECT * FROM comment
            INNER JOIN blogpost
            ON blogpost.id_blogpost = comment.id_blogpost
            WHERE blogpost.id_blogpost = :id
             AND comment.content = :content', $array);
    }
    /**
     * @param $id_BlogPost
     * @param $id_comment
     * @return object
     * Returns one comment that matches a id
     */
    public function fetchOneCommentById($id_BlogPost, $id_comment)
    {
        /**
         * @return array
         */
        $array = [[':id', $id_BlogPost,PDO::PARAM_INT], [':id2', $id_comment, PDO::PARAM_INT] ];
        return $this->fetchOne('
            SELECT * FROM comment
            INNER JOIN blogpost
            ON blogpost.id_blogpost = comment.id_blogpost
            WHERE blogpost.id_blogpost = :id
             AND comment.id_comment = :id2',  $array);
    }

    /**
     * @param $id_comment
     * @return boolean
     * deactivate a comment that matches an id
     */
    public function disableComment($id_comment)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':id', $id_comment, PDO::PARAM_INT]];
        return $this->fetchOne('
            UPDATE comment SET
            actif = 0
            WHERE comment.id_comment = :id',$array);
    }

    /**
     * @param $id_comment
     * @return boolean
     * publish a comment that matches an id
     */
    public function publishComment($id_comment)
    {
        /**
         * @return boolean
         */
        $array = [[':id', $id_comment, PDO::PARAM_INT]];
        return $this->fetchOne('
            UPDATE comment SET
            publish = 1
            WHERE comment.id_comment = :id', $array);
    }

    /**
     * @param $comment
     * @return boolean
     * create a comment from an object
     */
    public function createComment($comment)
    {
        $req = 'INSERT INTO comment (content, dateCreate, publish, actif, id_blogPost, id_author) VALUES (?, ?, ?, ?, ?, ?)';
        $newComment = [
            $comment->getContent(),
            $comment->getDateCreate(),
            $comment->getPublish(),
            $comment->getActif(),
            $comment->getIdBlogPost(),
            $comment->getIdAuthor()
        ];
        return $this->execArray($req, $newComment);

    }

    /**
     * @param $id_blogPost
     * @return array
     * Return all comments disable that matches an id_blogPost
     */
    public function fetchAllCommentDisable($id_blogPost)
    {
        /**
         * @return array
         */
        $array = [[':id', $id_blogPost, PDO::PARAM_INT]];
        return $this->fetchAll('
            SELECT * FROM comment
            INNER JOIN user 
            ON user.id_user = comment.id_author
            WHERE comment.publish = 0
            AND comment.actif = 1
            AND comment.id_blogPost= :id
            ORDER BY comment.dateCreate DESC', $array);
    }
    /**
     * @param $id_user
     * @return array
     * Return all comments disable from one user that matches an id_user
     */
    public function fetchAllCommentDisableByIdUser($id_user)
    {
        /**
         * @return array
         */
        $array = [[':id', $id_user, PDO::PARAM_INT]];
        return $this->fetchAll('
            SELECT * FROM comment
            INNER JOIN user 
            ON user.id_user = comment.id_author
            WHERE comment.publish = 0
            AND comment.actif = 1
            AND comment.id_author= :id
            ORDER BY comment.dateCreate DESC', $array);
    }
}
