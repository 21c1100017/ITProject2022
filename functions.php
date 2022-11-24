<?php

function create_page(string $file_path, string $sub_title = '', array $heads = [], array $keywords = []) : string {

    global $root;
    $base = file_get_contents($root . 'templates/base.html');
    $html = file_get_contents($file_path);
    $html = str_replace('{{body}}', $html, $base);
    $title = (include($root . 'config.php'))['TITLE'];
    $head_html = '';

    if($sub_title != ''){
        $title = $sub_title . ' | ' . $title;
    }

    $html = str_replace('{{title}}', $title, $html);

    foreach($heads as $head){
        $head_html = $head_html . $head;
    }

    $html = str_replace('{{head}}', $head_html, $html);

    foreach($keywords as $key => $val){
        $html = str_replace('{{' . $key . '}}', $val, $html);
    }

    return $html;

}
