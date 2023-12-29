<?php
session_start();
require_once 'vendor/autoload.php';

use Ebog\Helper as h;

//дебагер tracy
/*
use Tracy\Debugger;
Debugger::enable();
*/

//новый дебагер whoops
use Ebog\WhoopsExeption;

$debug = new WhoopsExeption(new \Whoops\Run);
$debug->exeption();
//ошибка для проверки работы whoops
//throw new RuntimeException("Oh fudge napkins!");
/*
unset ($_SESSION['user']);
unset($_POST);
unset($_GET);
*/
/*
echo 'session';
h::dd($_SESSION);
echo 'get';
h::dd($_GET);
echo 'post';
h::dd($_POST);
*/
//роутер macaw
/*
use NoahBuscher\Macaw\Macaw;
//json
Macaw::get('/', 'Ebog\FrontendController@i');
Macaw::get('article/(:num)', 'Ebog\FrontendController@one');
//pdo
Macaw::get('/pdo', 'Ebog\PDOFrontentControler@pdoi');
Macaw::get('pdo/(:num)', 'Ebog\PDOFrontentControler@pdoone');
//opis
Macaw::get('/opis','Ebog\OpisFrontendController@iopis');
Macaw::get('opis/(:num)','Ebog\OpisFrontendController@oneopis');

/// admin panel routs

Macaw::get('/admin', 'Ebog\BackendController@index');
Macaw::post('/admin', 'Ebog\BackendController@index');
Macaw::get('/admin/logout', 'Ebog\BackendController@logout');
Macaw::get('admin/edit/(:num)', 'Ebog\BackendController@edit');
Macaw::get('/admin/delete/(:num)', 'Ebog\BackendController@delete');
Macaw::post('/admin/update', 'Ebog\BackendController@update');

//Macaw::get('/admin/save/(:num)','Ebog\BackendController@save');

//Macaw::error($view->showError());

Macaw::dispatch();
*/

// скрытый глобальный массив ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//новый роутер
use FastRoute\Dispatcher;
use PhpBench\Attributes as Bench;

$container = require __DIR__ . '/app/container.php';
//$userNews = $container->get('FrontContrl');
//$userNews->create();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    //json
    $r->addRoute('GET', '/', ['Ebog\FrontendController', 'index']);
    $r->addRoute('GET', '/page/{currentPage:\d+}', ['Ebog\FrontendController', 'index']);
    $r->addRoute('GET', '/article/{id}', ['Ebog\FrontendController', 'one']);
    //pdo
    $r->addRoute('GET', '/pdo', ['Ebog\PDOFrontentControler', 'pdoi']);
    $r->addRoute('GET', '/pdo/{id}', ['Ebog\PDOFrontentControler', 'pdoone']);
    //opis
    $r->addRoute('GET', '/opis', ['Ebog\OpisFrontendController', 'iopis']);
    $r->addRoute('GET', '/opis/{id}', ['Ebog\OpisFrontendController', 'oneopis']);
    /// admin panel routs
    $r->addRoute('GET', '/admin', ['Ebog\BackendController', 'index']);
    $r->addRoute('POST', '/admin', ['Ebog\BackendController', 'index']);
    $r->addRoute('POST', '/admin/auth', ['Ebog\BackendController', 'auth']);
    $r->addRoute('GET', '/admin/auth', ['Ebog\BackendController', 'auth']);
    $r->addRoute('GET', '/admin/logout', ['Ebog\BackendController', 'logout']);
    //articles
    $r->addRoute('GET', '/admin/edit/{id}', ['Ebog\BackendController', 'edit']);
    $r->addRoute('GET', '/admin/add', ['Ebog\BackendController', 'add']);
    $r->addRoute('GET', '/admin/delete/{id}', ['Ebog\BackendController', 'delete']);
    $r->addRoute('POST', '/admin/update/{id}', ['Ebog\BackendController', 'update']);
    $r->addRoute('GET', '/admin/save/{id}', ['Ebog\BackendController', 'save']);
    //register                                      don't work ???
    $r->addRoute('GET', '/admin/reg', ['Ebog\BackendController', 'reg']);
    //category
    $r->addRoute('GET', '/admin/showCategory', ['Ebog\BackendController', 'showCategory']);
    $r->addRoute('GET', '/admin/showEditCategory/{id}', ['Ebog\BackendController', 'showEditCategory']);
    $r->addRoute('POST', '/admin/updateCateg/{id}', ['Ebog\BackendController', 'updateCateg']);
    $r->addRoute('GET', '/admin/addCategory', ['Ebog\BackendController', 'addCateg']);
    $r->addRoute('GET', '/admin/editCateg/{id}', ['Ebog\BackendController', 'showEditCategory']);
    $r->addRoute('GET', '/admin/deleteCateg/{id}', ['Ebog\BackendController', 'deleteCateg']);

    //tag
    $r->addRoute('GET', '/admin/showTag', ['Ebog\BackendController', 'showTag']);
    $r->addRoute('GET', '/admin/showEditTag/{id}', ['Ebog\BackendController', 'showEditTag']);
    $r->addRoute('POST', '/admin/updateTag/{id}', ['Ebog\BackendController', 'updateTag']);
    $r->addRoute('GET', '/admin/addTag', ['Ebog\BackendController', 'addTag']);
    $r->addRoute('GET', '/admin/editTag/{id}', ['Ebog\BackendController', 'showEditTag']);
    $r->addRoute('GET', '/admin/deleteTag/{id}', ['Ebog\BackendController', 'deleteTag']);
    //user
    $r->addRoute('GET', '/admin/showUser', ['Ebog\BackendController', 'showUser']);
    $r->addRoute('GET', '/admin/showEditUser/{id}', ['Ebog\BackendController', 'showEditUesr']);
    $r->addRoute('GET', '/admin/addUser', ['Ebog\BackendController', 'addUser']);
    $r->addRoute('POST', '/admin/updateUser/{id}', ['Ebog\BackendController', 'updateUser']);
    $r->addRoute('GET', '/admin/deleteUser/{id}', ['Ebog\BackendController', 'deleteUser']);
    //role
    $r->addRoute('GET', '/admin/showRole', ['Ebog\BackendController', 'showRole']);
    $r->addRoute('GET', '/admin/showEditRole/{id}', ['Ebog\BackendController', 'showEditRole']);
    $r->addRoute('GET', '/admin/addRole', ['Ebog\BackendController', 'addRole']);
    $r->addRoute('POST', '/admin/updateRole/{id}', ['Ebog\BackendController', 'updateRole']);
    $r->addRoute('GET', '/admin/deleteRole/{id}', ['Ebog\BackendController', 'deleteRole']);

});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // show error 404
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        break;
    case FastRoute\Dispatcher::FOUND:
        $controller = $routeInfo[1];
        $parameters = $routeInfo[2];

        // We could do $container->get($controller) but $container->call()
        // does that automatically
        $container->call($controller, $parameters);
        break;
}
