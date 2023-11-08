<?php


namespace Ebog;


class OpisFrontendController
{
    private $opismodel;
    public function __construct($opisModel)
    {
        $this->opismodel = $opisModel;
    }
    public function iopis()
    {
       echo $this->opismodel->getAll();
    }
    public function oneopis($id)
    {
        echo $this->opismodel->getByID($id);
    }
}