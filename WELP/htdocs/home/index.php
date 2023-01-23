<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/post.php');
require_once($root . 'functions/timeline.php');
require_once($root . 'config/login_required.php');

$posts = '';

foreach(searchPosts(amount: 100) as $post){

    $author = $post->getUser();
    $iconPath = 'https://pics.prcm.jp/654b637d854c5/84936407/png/84936407.png';

    if($author != null){
        $name = $author->getName();
        if($author->getPicture() != null){
            $iconPath = $root_url . 'home/icon.php?id=' . $author->getPicture();
        }
    }else{
        $name = '(消去されたユーザー)';
    }

    $posts = $posts . createPost(
        $root . 'templates/home/post_box.html',
        [
            'icon_path' => $iconPath,
            'name' => $name,
            'created_at' => $post->getCreatedAt(),
            'content' => $post->getContent(),
            'favos' => $post->getFavorites(),
            'post_id' => $post->getId()
        ]
    );
}

$html = create_page(
    $root . 'templates/home/timeline.html',
    'ホーム',
    [
        '<link rel="stylesheet" href="' . $root_url . 'statics/css/home.css">'
    ],
    [
        'posts' => $posts
    ]
);

print($html);
