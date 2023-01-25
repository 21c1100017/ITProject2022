<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/post.php');
require_once($root . 'functions/timeline.php');
require_once($root . 'config/login_required.php');

$posts = '';

if(isset($_POST['post-content'])){
    sendPost(
        getUserFromId($_SESSION['user_id']),
        null,
        $_POST['post-content']
    );
    header('Location: ./');
    exit;
}

foreach(searchPosts(amount: 100) as $post){
    $posts = $posts . createPost($post->getId());
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
