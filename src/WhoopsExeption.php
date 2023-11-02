<?php


namespace Ebog;

use RuntimeException;
use Whoops\Handler\JsonResponseHandler;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;
 class WhoopsExeption
{
    private $whoops;
    public function  __construct()
    {
        $this->whoops = new \Whoops\Run;
    }

    public function exeption()
    {
        $this->whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);

        if (\Whoops\Util\Misc::isAjaxRequest()) {
            $jsonHandler = new JsonResponseHandler();
            $jsonHandler->setJsonApi(true);
            $this->whoops->pushHandler($jsonHandler);
        }
       return $this->whoops->register();
    }

}