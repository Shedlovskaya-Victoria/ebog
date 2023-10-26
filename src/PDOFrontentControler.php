<?php


namespace Ebog;

use \Ebog\ModelPDO;
use Ebog\Helper as h;

class PDOFrontentControler
{
    private \Ebog\ModelPDO $pdomodel;
    public  function __construct()
    {
        $this->pdomodel = new \Ebog\ModelPDO();
    }
    public  function pdoi()
    {
        echo h::dd($this->pdomodel->getArticles());
    }
    public function pdoone($id)
    {
        echo $this->pdomodel->getArticlesByID($id);
    }
}