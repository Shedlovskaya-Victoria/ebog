<?php


namespace Ebog;
class OpisModel
{
    private $db;
    public function __construct($opisDatabase){
       $this->db = $opisDatabase;
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