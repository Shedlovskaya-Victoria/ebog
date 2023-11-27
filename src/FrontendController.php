<?php


namespace Ebog;

use \Ebog\FrontendView;
use \Ebog\Model;
use \Ebog\Helper as h;


class FrontendController
{
    private \Ebog\FrontendView $view;
    private  $model;


    public function __construct(FrontendView $view, $model)
    {
        $this->model = $model;
        $this->view = $view;
    }

    public function index($currentPage = 1)
    { /*
    $kol - количество записей для вывода
    $art - с какой записи выводить
    $total - всего записей
    $page - текущая страница
    $str_pag - количество страниц для пагинации

        //$articles = $this->model->getAll();

        // Текущая страница
        if (isset($_GET['page'])){
            $page = $_GET['page'];
        }else {
            $page = 1;
    */

        $kol = 3;  // количество записей для вывода
        $art = ($currentPage * $kol) - $kol;
       // echo $art;

        $total = $this->model->countAllPages(); // всего записей

        // Количество страниц для пагинации
        $str_pag = ceil($total / $kol);
       // echo $str_pag;

        /*$articles = $this->model->getArticles();
        */
        $articles = $this->model->getPaginationPage($art, $str_pag);

        $this->view->showBlog($articles, $str_pag);
    }

    public function one($id)
    {
        $article = $this->model->getArticleByID($id);
        $articles = $this->model->getAll();
        //$articles = $this->model->getArticles();
        $this->view->showBlogDetails($article, $articles);
    }


}