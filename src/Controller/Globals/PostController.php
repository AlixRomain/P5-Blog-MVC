<?php


namespace App\Controller\Globals;


/**
 * Class PostController
 */
class PostController
{
    /**
     * @var mixed
     */
    private $post;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        $this->post = filter_input_array(INPUT_POST);
    }

    /**
     * @return mixed
     */
    public function getArrayPost()
    {
        return $this->post;
    }

    /**
     * @param string $var
     * @return mixed
     */
    public function getDataPost(string $var)
    {
        return $this->post[$var];
    }

}