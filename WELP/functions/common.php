<?php

function create_page(string $file_path, string $sub_title = '', array $heads = [], array $keywords = [], bool $use_footer = true) : string
{

    global $root, $root_url;
    $base = file_get_contents($root . 'templates/base.html');
    $html = file_get_contents($file_path);
    $html = str_replace('{{body}}', $html, $base);
    $title = (include($root . 'config/config.php'))['TITLE'];
    $head_html = '';

    $html = str_replace('{{top_url}}', $root_url, $html);

    if($sub_title != ''){
        $title = $sub_title . ' | ' . $title;
    }

    $html = str_replace('{{title}}', $title, $html);

    foreach($heads as $head){
        $head_html = $head_html . $head;
    }

    $html = str_replace('{{head}}', $head_html, $html);

    if($use_footer){
        $footer_html = file_get_contents($root . 'templates/footer.html');
        $footer_html = str_replace('{{home_url}}', $root_url . 'home', $footer_html);
        $footer_css = '<link rel="stylesheet" href="' . $root_url . 'statics/css/footer.css">';
    }else{
        $footer_html = '';
        $footer_css = '';
    }

    $html = str_replace('{{base_css}}', $root_url . 'statics/css/base.css', $html);
    $html = str_replace('{{footer_html}}', $footer_html, $html);
    $html = str_replace('{{footer_css}}', $footer_css, $html);

    foreach($keywords as $key => $val){
        $html = str_replace('{{' . $key . '}}', $val, $html);
    }

    return $html;

}
