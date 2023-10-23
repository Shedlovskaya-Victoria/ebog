<?php
namespace Ebog;


class Helper
{

    public static function dd($some){
        print_r('<pre>');
        print_r($some);
        print_r('</pre>');
    }
    public static function goUrl(string $url){
        echo '<script type="text/javascript">location="';
        echo $url;
        echo '";</script>';
    }
}