<?php


namespace App\Model;


class BlogPostModel extends MasterModel
{
    /**
     * @return array
     */
    public function fetchAllArticle()
    {
        return $this->fetchAll('
            SELECT * FROM blogPost
            INNER JOIN user 
            ON user.id_user = blogpost.id_author
            WHERE blogPost.publish = 1
            ');
    }

}