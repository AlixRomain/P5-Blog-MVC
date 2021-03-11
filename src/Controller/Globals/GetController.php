<?php


namespace App\Controller\Globals;


/**
 * Class GetController
*/
class GetController
{

    /**
     * @var mixed
     */
    private $get;

    /**
     * GetController constructor.
     */
    public function __construct()
    {
        $def = array(
            'page' => FILTER_SANITIZE_SPECIAL_CHARS,//Echappe les caractères spéciaux
            'idBlogPost' => FILTER_SANITIZE_NUMBER_INT,//Ne garde que chiffre, +, -
            'idUser' => FILTER_SANITIZE_NUMBER_INT
        );

        $this->get = filter_input_array(INPUT_GET, $def);//Ne garde dans l'INPUT_GET que les datas filtrés par $def
    }

    /**
     * @return mixed
     */
    public function getArrayGet()//retourne Un tableau de var
    {
        if (empty($this->get)) {
            return false;
        }
        return $this->get;
    }

    /**
     * @param string $var
     * @return mixed
     */
    public function getDataGet(string $var)//Retourne une variable
    {
        if (empty($this->get[$var])) {
            return false;
        }
        return $this->get[$var];
    }
}
