<?php

use function DI\create;
use SuperBlog\Model\ArticleRepository;
use SuperBlog\Persistence\InMemoryArticleRepository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return [
    // Bind an interface to an implementation
    ArticleRepository::class => create(InMemoryArticleRepository::class),

    // Configure Twig
    Environment::class => function () {
        $loader = new FilesystemLoader(__DIR__ . '/template/backend');
        return new Environment($loader);
    },
    'FrontView'=> create(\Ebog\FrontendView::class)->
    constructor(
        get(new \Twig\Loader\FilesystemLoader('template/frontend'),
            new \Twig\Environment($this->loader, []))
    )
];