<?php
session_start();
require_once 'vendor/autoload.php';
use Ebog\Helper as h;
use NoahBuscher\Macaw\Macaw;
use Tracy\Debugger;

Debugger::enable();
//unset ($_SESSION['user']);
//unset($_POST);
//unset($_GET);

echo 'session';
h::dd($_SESSION);
echo 'get';
h::dd($_GET);
echo 'post';
h::dd($_POST);
Macaw::get('/', 'Ebog\FrontendController@i');
Macaw::get('article/(:num)', 'Ebog\FrontendController@one');
Macaw::get('/pdo', 'Ebog\FrontendController@pdoi');
Macaw::get('pdo/(:num)', 'Ebog\FrontendController@pdoone');


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