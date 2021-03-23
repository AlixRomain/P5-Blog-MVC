<?php


namespace App\Model;


use PDO;

class BlogPostModel extends MasterModel
{
    /**
     * @param null $array
     * @return array
     *  Return all blogpost
     */
    public function fetchAllBlogpost($array = null)
    {
        /**
         * @return array
         */
        return $this->fetchAll('
SELECT * FROM blogpost
INNER JOIN user
ON user.id_user = blogpost.id_author
WHERE blogpost.publish = 1
AND blogpost.actif = 1
ORDER BY CASE WHEN blogpost.dateUpdate > blogpost.dateCreate
THEN blogpost.dateUpdate ELSE blogpost.dateCreate END DESC
', $array);
}
/**
* @param null $array
* @return array
* Return all blogpost with comments disable
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
* disable one blogpost that matches an id_blogPost
*/
public function disableBlogPost($id_blogPost)
{
/**
* @return boolean
*/
$array = [[':id', $id_blogPost,PDO::PARAM_INT] ];
return $this->execOne('
UPDATE blogpost SET
actif = 0
WHERE blogpost.id_blogPost = :id',$array);
}

/**
* @param $title
* @return object
* return blogpost that matches an title
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
* @param $id_blogPost
* @return object
* Return one blogpost  that matches an id_blogPost
*/
public function fetchOneBlogPostById($id_blogPost)
{
/**
* @return object
*/

$array = [[':id', $id_blogPost, PDO::PARAM_INT] ];
return $this->fetchOne('
SELECT * FROM blogpost
INNER JOIN user
ON user.id_user = blogpost.id_author
WHERE blogpost.publish = 1
AND blogpost.actif = 1
AND id_blogPost = :id',$array );
}
/**
* @param $blogpost
* @return boolean
* insert one blogpost from one object
*/
public function createBlogPost($blogpost)
{
$req = 'INSERT INTO blogpost (title, chapo, content, dateCreate, dateUpdate, publish, actif, id_author) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
$blog = [
$blogpost->getTitle(),
$blogpost->getChapo(),
$blogpost->getContent(),
$blogpost->getDateCreate(),
$blogpost->getDateUpdate(),
$blogpost->getPublish(),
$blogpost->getActif(),
$blogpost->getIdAuthor()
];

return $this->execArray($req, $blog);
}
/**
* @param $blogpost
* @param $id_blogPost
* @return boolean
* update one blogpost from one object that matches an id_blogPost
*/
public function updateBlogPost($blogpost, $id_blogPost)
{

$req = 'UPDATE blogpost SET title = :title, chapo = :chapo, content = :content, dateUpdate = :dateUpdate WHERE blogpost.id_blogPost = :id';
$blog =[
'title'      => $blogpost->getTitle(),
'chapo'     => $blogpost->getChapo(),
'content'   => $blogpost->getContent(),
'dateUpdate'=> $blogpost->getDateCreate(),
'id'        => $id_blogPost
];
return $this->execArray($req, $blog);
}
}
