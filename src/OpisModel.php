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
        $article = $this->db->from('article')->select()->fetchBoth()->all();
        return $article;
            /*
        foreach ($result as $res){
          echo $res['id'].'| '.$res['title'].'| '.$res['content'].'| <br/>';
        }*/
        /*
        foreach ($result as $r){
            echo $r['id'].'| '.$r['title'].'| '.$r['content'].'.';
        }
        */
    }
    public function getPaginationPage($limit, $art)
    {
        $article = $this->db->from('article')
            ->limit($art)
            ->offset($limit)
            ->select()->fetchBoth()->all();
        return $article;
    }
    public function countAllPages()
    {
        return $this->db->from('article')->count();
    }
    public function getArticleByID($id)
    {
        $article = $this->db->from('article')
            ->where('id')
            ->atLeast($id)
            ->select()
            ->fetchBoth()->first();
        return //Helper::dd(
            (array('id' => $article['id'],
            'title' => $article['title'],
            'image' => $article['image'],
            'content' => $article['content'])
            // )
    );//echo $article['id'].'| '.$article['title'].'| '.$article['content'].'| <br/>';
    }
/*тестовый CRUD JohnDoe
    public function addJohnDoe()
    {
        //add
        $result = $this->db->insert(array(
            'title' => 'John Doe',
            'image'=>'',
            'content' => 'john.doe@example.com'
        ))
            ->into('Article');
    }
    public function deleteJohnDoe($id)
    {
        $result = $this->db->from('Article')
            ->where('id')->is($id)
            ->delete(array('Article'));
    }
    public  function updateJohnDoe($id, $arr = [])
    {
        $result = $this->db->update('Article')
            ->where('id')->is($id)
            ->set(array(
                'title' => $arr['title'],
                'image'=>'',
                'content' => $arr['content']
            ));
    }
*/
    public  function update($id)
    {
        if(isset($_POST['inputTitle']) & isset($_POST['inputContent'])) {
            $result = $this->db->update('Article')
                ->where('id')->is($id)
                ->set(array(
                    'title' => $_POST['inputTitle'],
                    'image' => $_POST['inputImage'],
                    'content' => $_POST['inputContent']
                ));
        }
    }
    public function delete($id)
    {
        $result = $this->db->from('article')
            ->where('id')->is($id)
            ->delete(array('article'));
    }
    public function add()
    {
        //add
        if(isset($_POST['inputTitle']) & isset($_POST['inputContent'])) {
            $result = $this->db->insert(array(
                'title' => $_POST['inputTitle'],
                'image' => $_POST['inputImage'],
                'content' => $_POST['inputContent']
            ))
                ->into('article');
        }
    }
}