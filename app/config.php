<?php

use function DI\create;
use function DI\get;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use PDO;
use Opis\Database\Database;
use Opis\Database\Connection;

$connectionOpis = new Connection(
    $_ENV['DB_DSN'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']);

$connectionOpis->options([
    PDO::FETCH_ASSOC=>true,
    PDO::ATTR_STRINGIFY_FETCHES=> false
]);

//dd(__DIR__.'/../template/frontend');
return [
    'FrontLoader' => create(FilesystemLoader::class)
        ->constructor( __DIR__.'/../template/frontend'),
    'BackLoader' => create(FilesystemLoader::class)
        ->constructor(__DIR__.'/../template/backend'),
    'FrontTwig' => create(Environment::class)
        ->constructor(get('FrontLoader', [])),
    'BackTwig' => create(Environment::class)
        ->constructor(get('BackLoader', [])),
    'FrontView' => create(\Ebog\FrontendView::class)
        ->constructor(get('FrontTwig')),
    'Model'=> create(\Ebog\Model::class),
    //'OpisConn'=>create(Connection::class)
    //->constructor(get($connectionOpis)),
    'OpisDB'=>create(Database::class)
    ->constructor(get($connectionOpis)),
    'OpisModel'=>create(\Ebog\OpisModel::class)
    ->constructor(get('OpisDB')),
    'OpisFrontCntrl'=>create(\Ebog\OpisFrontendController::class)
    ->constructor(get('OpisModel')),


    Ebog\FrontendController::class => create( Ebog\FrontendController::class)
    ->constructor(
       get('FrontView'),
       get('Model')

    )
];