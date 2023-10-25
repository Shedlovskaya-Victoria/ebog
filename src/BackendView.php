<?php

namespace Ebog;
use Ebog\Model;
class BackendView
{

    private $twig;
    private $loader;

    public function __construct()
    {
       $this->loader = new \Twig\Loader\FilesystemLoader('template/backend');
       $this->twig = new \Twig\Environment($this->loader, []);

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
    public  function  showBlogDetails(){
        echo $this->twig->render('blog-detail-list.twig', ['article' => $this->article]);
    }
    public  function showEdit($article)
    {
        echo  $this->twig->render('detail-edit.twig', ['article'=>$article]);
    }

}