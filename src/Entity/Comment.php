<?php


namespace App\Entity;

use App\Controller\Globals\Hydrator;

class Comment
{
    use Hydrator;
    private $id_comment;
    private $content;
    private $dateCreate;
    private $publish;
    private $actif;
    private $id_blogPost;
    private $id_author;


    public function __construct(Array $datas){
        $this->hydrate($datas);
    }


    /**
     * @return mixed
     */
    public function getIdComment()
    {
        return $this->id_comment;
    }


    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDateCreate()
    {
        return $this->dateCreate;
    }

    /**
     * @param mixed $dateCreate
     */
    public function setDateCreate($dateCreate): void
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return mixed
     */
    public function getPublish()
    {
        return $this->publish;
    }

    /**
     * @param mixed $publish
     */
    public function setPublish($publish): void
    {
        $this->publish = $publish;
    }

    /**
     * @return mixed
     */
    public function getActif()
    {
        return $this->actif;
    }

    /**
     * @param mixed $actif
     */
    public function setActif($actif): void
    {
        $this->actif = $actif;
    }

    /**
     * @return mixed
     */
    public function getIdBlogPost()
    {
        return $this->id_blogPost;
    }

    /**
     * @param mixed $id_blogPost
     */
    public function setIdBlogPost($id_blogPost): void
    {
        $this->id_blogPost = $id_blogPost;
    }

    /**
     * @return mixed
     */
    public function getIdAuthor()
    {
        return $this->id_author;
    }

    /**
     * @param mixed $id_author
     */
    public function setIdAuthor($id_author): void
    {
        $this->id_author = $id_author;
    }
}
