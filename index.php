<?php
session_start();
require_once 'vendor/autoload.php';
use Ebog\Helper as h;

//роутер macaw
//use NoahBuscher\Macaw\Macaw;

//дебагер tracy
//use Tracy\Debugger;
//Debugger::enable();

//новый дебагер whoops
use Ebog\WhoopsExeption;
$debug = new WhoopsExeption();
$debug->exeption();
//ошибка для проверки работы whoops
//throw new RuntimeException("Oh fudge napkins!");

//unset ($_SESSION['user']);
//unset($_POST);
//unset($_GET);

echo 'session';
h::dd($_SESSION);
echo 'get';
h::dd($_GET);
echo 'post';
h::dd($_POST);
/* json
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

Macaw::dispatch();*/

use FastRoute\Dispatcher;
use PhpBench\Attributes as Bench;
//
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$container = require __DIR__ . '/app/container.php';
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['Ebog\FrontendController','index']);
    // {id} must be a number (\d+)
    $r->addRoute('GET', '/admin', ['Ebog\BackendController','index']);
    // The /{title} suffix is optional
    $r->addRoute('GET', '/opis', ['Ebog\OpisFrontendController','iopis']);
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
        // ... 404 Not Found
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