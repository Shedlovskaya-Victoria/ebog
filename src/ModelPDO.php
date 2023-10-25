<?php


namespace Ebog;

use PDO;
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
        $this->pdo = new PDO($dsn, $user, $pass, $opt);


    }
    public function getArticles()
    {
        $stmt =$this->pdo->query('SELECT * FROM Article');
        while ($row = $stmt->fetch())
        {
            echo  $row['id'].'| '.$row['title'].'| '.$row['content'] . '<br/>';
        }
//        foreach($this->pdo->query('SELECT * from Article')->fetch() as $row) {
//            print_r($row);}
    }
    public function getArticlesByID($id)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM Article WHERE id = :id' );
        $stmt->execute(['id'=>$id]);
      // $array = $stmt->execute(array(":id" => $id));
      $row = $stmt->fetchAll();
       //return $row['id'].'| '.$row['title'].'| '.$row['content']  ;
        var_dump($row);
    }
}