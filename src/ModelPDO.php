<?php


namespace Ebog;

class ModelPDO
{
    private $pdo;
    public  function  __construct($pdo)
    {
        $this->pdo = $pdo;
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
     //   $stmt->execute(['id'=>$id]);
       $stmt->execute(['id' => $id]);
       $row = $stmt->fetch();
       return $row['id'].'| '.$row['title'].'| '.$row['content']  ;
       // var_dump($row);
    }
}