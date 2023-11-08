<?php
require_once 'vendor/autoload.php';
use DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder;
$containerBuilder->useAutowiring(false);
$containerBuilder->useAttributes(false);
$containerBuilder->addDefinitions(__DIR__ . '/config.php');
$container = $containerBuilder->build();

return $container;