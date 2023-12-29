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
    public function update($id)
    {/*if(isset($_POST['btnOk']))
     { //unset($_POST['btnOk']);*/
        $arrs = $this->model->getAll();
            //$arrs = $this->model->getArticles();
            if($id!=0)
            {
                $this->model->update($id);
                /*
            }
                $arrs[$id]['title'] = $_POST['inputTitle'];
                $arrs[$id]['content'] = $_POST['inputContent'];
                //unset($_GET['idEdit']);
                */
            }
            else{
                $this->model->add();
                /*
                $idNew = end($arrs);
                $arr2 = array('id' => ++$idNew['id'],
                    'title' => $_POST['inputTitle'],
                    'image' => '',
                    'content' => $_POST['inputContent']);
                array_push($arrs, $arr2);
            }
            file_put_contents('asd.json', json_encode($arrs));
                 */
        }
        h::goUrl('/admin');
    }
    public function updateCateg($id)
    {
        $arrs = $this->model->getAllCategory();
        if($id!=0)
        {
            $this->model->updateCateg($id);
        }
        else{
            $this->model->addCateg();
        }
        h::goUrl('/admin/showCategory');
    }
    public function updateTag($id)
    {
        $arrs = $this->model->getAllTag();
        if($id!=0)
        {
            $this->model->updateTag($id);
        }
        else{
            $this->model->addTag();
        }
        h::goUrl('/admin/showTag');
    }
    public function delete($id)
    {
        $this->model->delete($id);
        /*
        if (isset($id)) {
            $arr = $this->model->getArticles();
            //dd($arr);
            unset($arr[$id]);
            // dd($arr);
            file_put_contents('asd.json', json_encode($arr));
            h::goUrl('/admin');
        }
        */
        h::goUrl('/admin');
    }
    public function deleteCateg($id)
    {
        $this->model->deleteCateg($id);
        h::goUrl('/admin/showCategory');
    }
    public function deleteTag($id)
    {
        $this->model->deleteTag($id);
        h::goUrl('/admin/showTag');
    }
    public function auth()
    {
        if (!isset($_POST['btnLogin'])) {
            $this->showLoginForm();
            exit;
        } else {
            if ($this->checkLogin($_POST['login'], $_POST['password'])) {
                $_SESSION['user'] = 'admin';  //echo 'Вы залогинелись';
                h::goUrl('/admin');
            }else if ($this->checkLogin($_POST['login'], $_POST['password'])) {
                $_SESSION['user'] = 'user';  //echo 'Вы залогинелись';
                h::goUrl('/');
            } else {
               h::goUrl('/');
            };
        }
    }

    public function checkLogin(string $login, string $password)
    {
        if ($login == 'admin' and $password == 'admin') {
            return true;
        } else if ($login == 'user' and $password == 'user') {
            return false;
        }
        else
        {
            h::goUrl('/admin');
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
        $articles = $this->model->getAll();
      // $articles = $this->model->getArticles();
        $this->view->showAdmin($articles);
    }
    public function edit($id)
    {
        $article = $this->model->getArticleByID($id);
        $this->view->showEdit($article);
    }
    public function add()
    {
        $article = array('id' => 0,
            'title' => '',
            'image' => '',
            'content' => '');
        $this->view->showEdit($article);
    }
    public  function addCateg()
    {
        $article = array('id' => 0,
            'title' => '');
        $this->view->showEditCategory($article);
    }
    public  function addTag()
    {
        $article = array('id' => 0,
            'title' => '');
        $this->view->showEditTag($article);
    }
    public function save($id)
    {
        //$arrs = $this->model->getArticles();

        $arrs[$_POST['idEdit']]['title'] = $_POST['inputTitle'];
        $arrs[$_POST['idEdit']]['content'] = $_POST['inputContent'];

        file_put_contents('asd.json', json_encode($arrs));
    }
    public function reg(){
        $this->view->showReg();
    }

    public  function  showCategory(){
      $articles =  $this->model->getAllCategory();
        $this->view->showCategory($articles);
    }
    public  function  showEditCategory($id){
        $article =  $this->model->getByIdCategory($id);
        $this->view->showEditCategory($article);
    }
    public  function  showTag(){
        $articles = $this->model->getAllTag();
        $this->view->showTag($articles);
    }
    public  function  showEditTag($id){
        $article = $this->model->getByIdTag($id);
        $this->view->showEditTag($article);
    }
    //user
    public  function  showUser(){
        $articles = $this->model->getAllUser();
        $this->view->showUser($articles);
    }
    public  function  showEditUser($id){
        $article = $this->model->getByIdUser($id);
        $roles = $this->model->getAllRole();
        $this->view->showEditUser($article, $roles);
    }
    public  function addUser()
    {
        $article = array('id' => 0,
            'roleId' => '',
            'name' => '',
            'email' =>'',
            'username' => '',
            'passwordHash' => '');
        $this->view->showEditUser($article);
    }
    public function updateUser($id)
    {
        $arrs = $this->model->getAllUser();
        if($id!=0)
        {
            $this->model->updateUser($id);
        }
        else{
            $this->model->addUser();
        }
        h::goUrl('/admin/showUser');
    }
    public function deleteUser($id)
    {
        $this->model->deleteUser($id);
        h::goUrl('/admin/showUser');
    }
    //role
    public  function  showRole(){
        $articles = $this->model->getAllRole();
        $this->view->showRole($articles);
    }
    public  function  showEditRole($id){
        $article = $this->model->getByIdRole($id);
        $this->view->showEditRole($article);
    }
    public  function addRole()
    {
        $article = array('id' => 0,
            'title' => '',);
        $this->view->showEditRole($article);
    }
    public function updateRole($id)
    {
        $arrs = $this->model->getAllRole();
        if($id!=0)
        {
            $this->model->updateRole($id);
        }
        else{
            $this->model->addRole();
        }
        h::goUrl('/admin/showRole');
    }
    public function deleteRole($id)
    {
        $this->model->deleteRole($id);
        h::goUrl('/admin/showRole');
    }
}