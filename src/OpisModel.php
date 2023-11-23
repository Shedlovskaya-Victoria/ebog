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
        /*
        foreach ($result as $r){
            echo $r['id'].'| '.$r['title'].'| '.$r['content'].'.';
        }
        */
    }
    public function getByID($id)
    {
        $article = $this->db->from('Article')->where('id')->atLeast($id)->select()->fetchBoth()->first();
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
        $result = $this->db->update('Article')
            ->where('id')->is($id)
            ->set(array(
                'title' => $_POST['inputTitle'],
                'image'=>'',
                'content' => $_POST['inputContent']
            ));
    }
    public function delete($id)
    {
        $result = $this->db->from('Article')
            ->where('id')->is($id)
            ->delete(array('Article'));
    }
    public function add()
    {
        //add
        $result = $this->db->insert(array(
            'title' => $_POST['inputTitle'],
            'image'=>'',
            'content' => $_POST['inputContent']
        ))
            ->into('Article');
    }
}