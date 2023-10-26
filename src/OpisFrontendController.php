<?php


namespace Ebog;

use Ebog\OpisModel;
class OpisFrontendController
{
    private $opismodel;
    public function __construct()
    {
        $this->opismodel = new namespace\OpisModel();
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