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
        echo  $this->twig->render('detail-edit.twig', ['article'=>$article]);
    }

}