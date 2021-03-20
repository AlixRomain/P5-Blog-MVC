<?php


namespace App\Model;


use PDO;

class CommentModel extends MasterModel
{
    /**
     * @return array
     */
    public function fetchAllCommentByBlogpost($id_blogpost)
    {
        /**
         * @return array
         * Retourne
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
     * @return array
     */
    public function fetchOneCommentPostByContent($id_BlogPost, $content)
    {
        /**
         * @return array
         * Retourne
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
     * @return array
     */
    public function fetchOneCommentById($id_BlogPost, $id_comment)
    {
        /**
         * @return array
         * Retourne
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
     * @return array
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
     * @return array
     */
    public function publishComment($id_comment)
    {
        /**
         * @return array
         * Retourne
         */
        $array = [[':id', $id_comment, PDO::PARAM_INT]];
        return $this->fetchOne('
            UPDATE comment SET
            publish = 1
            WHERE comment.id_comment = :id', $array);
    }

    /**
     * @return array
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
     * @return array
     */
    public function fetchAllCommentDisable($id_blogPost)
    {
        /**
         * @return array
         * Retourne
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
     * @return array
     */
    public function fetchAllCommentDisableByIdUser($id_user)
    {
        /**
         * @return array
         * Retourne
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