<?php


namespace Ebog;

use \Ebog\FrontendView;
use \Ebog\Model;
use \Ebog\Helper as h;


class FrontendController
{
    private \Ebog\FrontendView $view;
    private \Ebog\Model $model;


    public function __construct(FrontendView $view, $model)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index()
    {
        $articles = $this->model->getArticles();
        $this->view->showBlog($articles);
    }

    public function one($id)
    {
        $article = $this->model->getArticleByID($id);
        $articles = $this->model->getArticles();
        $this->view->showBlogDetails($article, $articles);
    }


}