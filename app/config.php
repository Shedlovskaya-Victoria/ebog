<?php

use function DI\create;
use function DI\get;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;


use Opis\Database\Database;
use Opis\Database\Connection;




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
    'BackView' => create(\Ebog\BackendView::class)
        ->constructor(get('BackTwig', [])),
    //'OpisConn'=>create(Connection::class)
    //->constructor(get($connectionOpis)),
    'OpisConnection' => function( ){
        $connectionOpis = new Connection(
            $_ENV['DB_DSN'],
            $_ENV['DB_USERNAME'],
            $_ENV['DB_PASSWORD']);
        $connectionOpis->options([
            PDO::FETCH_ASSOC=>true,
            PDO::ATTR_STRINGIFY_FETCHES=> false]);
    return $connectionOpis;
        },
    'OpisDB'=>create(Database::class)
    ->constructor(get('OpisConnection')),
    'OpisModel'=>create(\Ebog\OpisModel::class)
    ->constructor(get('OpisDB')),
    'OpisFrontCntrl'=>create(\Ebog\OpisFrontendController::class)
    ->constructor(get('OpisModel')),
    'PDO'=>function(){
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        return new PDO($_ENV['DB_PDO_DSN'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD'], $opt);

    },
    'PDOModel'=>create(\Ebog\ModelPDO::class)
    ->constructor(get('PDO')),

    Ebog\BackendController:: class=>create(\Ebog\BackendController::class)
    ->constructor(
        get('OpisModel'),
        get('BackView')),
    Ebog\PDOFrontentControler::class=>create(Ebog\PDOFrontentControler::class)
    ->constructor(get('PDOModel')),
    Ebog\OpisFrontendController::class=>create(Ebog\OpisFrontendController::class)
    ->constructor(get('OpisModel')),
   Ebog\FrontendController::class => create( Ebog\FrontendController::class)
    ->constructor(
       get('FrontView'),
       get('OpisModel')
    )
];