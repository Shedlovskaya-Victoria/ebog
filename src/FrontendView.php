<?php

namespace Ebog;

class FrontendView
{

    private $twig;
    private $loader;

    public function __construct($loader, $twig)
    {
        $this->loader = $loader;
        $this->twig = $twig;
    }

    public function showBlog($articles)
    {
        echo $this->twig->render('blog-card-list.twig', ['articles' => $articles]);
    }

    public function showError()
    {
        echo $this->twig->render('error.twig', []);
    }

    public function showBlogDetails($article)
    {
        echo $this->twig->render('blog-detail-list.twig', ['article' => $article]);
    }
}