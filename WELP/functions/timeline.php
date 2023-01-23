<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');

function createPost(String $fileName, array $keywords = []) : String
{
    $html = file_get_contents($fileName);

    foreach($keywords as $key => $val){
        $html = str_replace('{{' . $key . '}}', htmlspecialchars($val, ENT_QUOTES, 'UTF-8'), $html);
    }

    return $html;

}
