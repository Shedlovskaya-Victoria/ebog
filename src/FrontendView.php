<?php

namespace Ebog;

class FrontendView
{

    private $twig;
   // private $loader;

    public function __construct($twig)
    {
       // $this->loader = $loader;
        $this->twig = $twig;
    }

    public function showBlog($articles, $str_pag)
    {
        echo $this->twig->render('blog-card-list.twig',
            ['articles' => $articles, 'str_pag' => $str_pag]);
    }

    public function showError()
    {
        echo $this->twig->render('error.twig', []);
    }

    public function showBlogDetails($article, $articles)
    {
        echo $this->twig->render('blog-detail-list.twig', ['article' => $article, 'articles'=>$articles]);
    }
}