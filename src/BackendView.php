<?php

namespace Ebog;
use Ebog\Model;
class BackendView
{

    private $twig;
    private $loader;

    public function __construct($twig)
    {
       //$this->loader = new $twig;
       $this->twig = $twig;
    }

    public function showLogin(){
       echo $this->twig->render('login.twig', []);
    }
     public function showBlog(){
        echo $this->twig->render('blog-card-list.twig', ['articles'=>$this->articles]);
     }
    public function showAdmin($articles){
        echo $this->twig->render('table-detail-list.twig', ['articles'=>$articles]);
    }
    public function showError(){
        echo $this->twig->render('error.twig', []);
    }
    public  function  showBlogDetails($articles){
        echo $this->twig->render('blog-detail-list.twig', ['article' => $this->article, 'articles'=>$articles]);
    }
    public  function showEdit($article)
    {
        echo  $this->twig->render('article-detail-edit.twig', ['article'=>$article]);
    }
    public  function  showReg(){
        echo $this->twig->render('red.twig',[]);
    }
    public function  showCategory($articles){
        echo $this->twig->render('category-table-detail.twig', ['articles'=>$articles]);
    }
    public  function showEditCategory($article)
    {
        echo  $this->twig->render('category-detail-edit.twig', ['article'=>$article]);
    }
    public function  showTag($articles){
        echo $this->twig->render('tag-table-datail.twig', ['articles'=>$articles]);
    }
    public  function showEditTag($article)
    {
        echo  $this->twig->render('tag-detail-edit.twig', ['article'=>$article]);
    }
}