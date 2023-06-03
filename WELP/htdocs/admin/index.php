<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/post.php');
// require_once($root . 'config/login_required.php');

$user = getUserFromId($_SESSION['user_id']);


/* if(!$user->isAdmin()){
    header('Location: /');
    exit;
} */

$rows = '';

foreach(searchPosts(reply: true, amount: 9999) as $post){
    $rows = $rows . '<tr>';
    $rows = $rows . '<td>' . $post->getId() . '</td>';
    $rows = $rows . '<td>' . $post->getUser()->getId() . '</td>';
    if($post->getFromPost() != null){
        $rows = $rows . '<td>' . $post->getFromPost()->getUser()->getId() . '</td>';
    }else{
        $rows = $rows . '<td>NULL</td>';
    }
    $rows = $rows . '<td>' . htmlspecialchars($post->getContent(), ENT_QUOTES) . '</td>';
    $rows = $rows . '<td>' . $post->getCreatedAt() . '</td>';
    $rows = $rows . '<td><a href=\'./delete.php?id=' . $post->getId() . '\'><button>消去</button></a></td>';
    $rows = $rows . '</tr>';
}

$html = create_page(
    file_path: $root . 'templates/admin/admin.html',
    sub_title: '管理画面',
    heads: [],
    keywords: [
        'post_rows' => $rows
    ]
);

print($html);
