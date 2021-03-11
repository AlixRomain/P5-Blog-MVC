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
            AND comment.id_blogpost ='. $id_blogpost);
    }

}