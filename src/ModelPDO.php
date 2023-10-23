<?php


namespace Ebog;


class ModelPDO
{
    private $pdo;
    public  function  __construct()
    {
        $host = 'localhost';
        $db   = '1135_Shed';
        $user = 'admin';
        $pass = 'admin';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $opt);
    }
}