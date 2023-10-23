<?php
namespace Ebog;


class Model
{
    function getArticles() : array
    {
        return  json_decode(file_get_contents('asd.json'), true);
    }
    function getArticleByID($id)
    {
        $arr = $this->getArticles();
        if(array_key_exists($id, $arr))
        {
            return $arr[$id];
        }
    }

}