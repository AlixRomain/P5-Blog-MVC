<?php


namespace App\Model;


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
        return $this->fetchAll('
            SELECT * FROM comment
            INNER JOIN user 
            ON user.id_user = comment.id_author
            WHERE comment.publish = 1
            AND comment.actif = 1
            AND comment.id_blogpost ='.$id_blogpost.'
            ORDER BY comment.dateCreate DESC
            ');

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
        $content = Connexion::getPDO()->quote($content);
        return $this->fetch('
            SELECT * FROM comment
            INNER JOIN blogpost
            ON blogpost.id_blogpost = comment.id_blogpost
            WHERE blogpost.id_blogpost = '.$id_BlogPost.'
             AND comment.content ='.$content);
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
        return $this->fetch('
            SELECT * FROM comment
            INNER JOIN blogpost
            ON blogpost.id_blogpost = comment.id_blogpost
            WHERE blogpost.id_blogpost = '.$id_BlogPost.'
             AND comment.id_comment ='.$id_comment);
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
        return $this->fetch('
            UPDATE comment SET
            actif = 0
            WHERE comment.id_comment ='.$id_comment);
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
        return $this->fetch('
            UPDATE comment SET
            publish = 1
            WHERE comment.id_comment ='.$id_comment);
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
        return $this->fetchAll('
            SELECT * FROM comment
            INNER JOIN user 
            ON user.id_user = comment.id_author
            WHERE comment.publish = 0
            AND comment.actif = 1
            AND comment.id_blogPost= '.$id_blogPost.'
            ORDER BY comment.dateCreate DESC');
    }

}