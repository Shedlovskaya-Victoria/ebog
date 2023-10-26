<?php


namespace Ebog;

use \Ebog\FrontendView;
use \Ebog\Model;
use \Ebog\Helper as h;


class FrontendController
{
    private \Ebog\FrontendView $view;
    private \Ebog\Model $model;


    public function __construct()
    {
        $this->model = new \Ebog\Model();
        $this->view = new \Ebog\FrontendView();

    }

    public function i()
    {
        $articles = $this->model->getArticles();
        $this->view->showBlog($articles);
    }

    public function one($id)
    {
        $article = $this->model->getArticleByID($id);
        $this->view->showBlogDetails($article);
    }


}