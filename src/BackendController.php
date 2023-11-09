<?php


namespace Ebog;

use Ebog\FrontendView;
use Ebog\Model;
use Ebog\Helper as h;

class BackendController
{
    private  $view;
    private $model;
    public  function  __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;

        if (!isset($_SESSION['user'])) {
            $this->auth();
        }
    }
    public  function update()
    {
        if(isset($_POST['btnOk']))
        { //unset($_POST['btnOk']);
            $arrs = $this->model->getArticles();
            if(isset($_POST['idEdit']))
            {
                $arrs[$_POST['idEdit']]['title'] = $_POST['inputTitle'];
                $arrs[$_POST['idEdit']]['content'] = $_POST['inputContent'];
                //unset($_GET['idEdit']);
            }
            else{
                $id = end($arrs);
                $arr2 = array('id' => ++$id['id'],
                    'title' => $_POST['inputTitle'],
                    'image' => '',
                    'content' => $_POST['inputContent']);
                array_push($arrs, $arr2);
            }
            file_put_contents('asd.json', json_encode($arrs));
        }
        h::goUrl('/admin');
    }
    public function delete($id)
    {
        if (isset($id)) {
            $arr = $this->model->getArticles();
            //dd($arr);
            unset($arr[$id]);
            // dd($arr);
            file_put_contents('asd.json', json_encode($arr));
            h::goUrl('/admin');
        }
    }

    public function auth()
    {
        if (!isset($_POST['btnLogin'])) {
            $this->showLoginForm();
            exit;
        } else {
            if ($this->checkLogin($_POST['login'], $_POST['password'])) {
                $_SESSION['user'] = 'admin';
                //echo 'Вы залогинелись';
                h::goUrl('/admin');
            } else {
                h::goUrl('/admin');
            };
        }
    }

    public function checkLogin(string $login, string $password): bool
    {
        if ($login == 'admin' and $password == 'admin') {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        session_destroy();
        h::goUrl('/admin');
    }
    public function showLoginForm()
    {
        $this->view->showLogin();
    }
    public function index()
    {
       $articles = $this->model->getArticles();
        $this->view->showAdmin($articles);
    }
    public function edit($id)
    {
        $article = $this->model->getArticleByID($id);
        $this->view->showEdit($article);
    }

}