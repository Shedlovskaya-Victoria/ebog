<?php


namespace Ebog;

use \Ebog\FrontendView;
use \Ebog\Model;
use \Ebog\Helper as h;
use \Ebog\ModelPDO;

class FrontendController
{
    private \Ebog\FrontendView $view;
    private \Ebog\Model $model;
    private \Ebog\ModelPDO $pdomodel;

    public function __construct()
    {
        $this->model = new \Ebog\Model();
        $this->view = new \Ebog\FrontendView();
        $this->pdomodel = new \Ebog\ModelPDO();
    }

    public function i()
    {
        $articles = $this->model->getArticles();
        $this->view->showBlog($articles);
    }
    public  function pdoi()
    {
       echo h::dd($this->pdomodel->getArticles());
    }
    public function pdoone($id)
    {
        echo $this->pdomodel->getArticlesByID($id);
    }


    public function one($id)
    {
        $article = $this->model->getArticleByID($id);
        $this->view->showBlogDetails($article);
    }


}