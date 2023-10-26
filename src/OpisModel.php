<?php


namespace Ebog;
use PDO;
use Opis\Database\Database;
use Opis\Database\Connection;
class OpisModel
{

    private $db;
    public function __construct(){
        $connection = new Connection(
            'mysql:host=localhost;dbname=1135_Shed',
            'admin',
            'admin');
        $connection->options([
            PDO::FETCH_ASSOC=>true,
            PDO::ATTR_STRINGIFY_FETCHES=> false
        ]);
       // $this->connection->option(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      //  $this->connection->option(PDO::ATTR_STRINGIFY_FETCHES, false);

       $this->db = new Database($connection);
    }
    public function getAll()
    {
        $result = $this->db->from('Article')->select()->fetchBoth()->all();
        foreach ($result as $res){
          echo $res['id'].'| '.$res['title'].'| '.$res['content'].'| <br/>';
        }
       // foreach ($result as $r){
         //   echo $r['id'].'| '.$r['title'].'| '.$r['content'].'.';
       // }
    }
    public function getByID($id)
    {
        $article = $this->db->from('Article')->where('id')->atLeast($id)->select()->fetchBoth()->first();
        echo $article['id'].'| '.$article['title'].'| '.$article['content'].'| <br/>';
    }

}