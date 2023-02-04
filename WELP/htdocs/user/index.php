<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/user.php');
require_once($root . 'functions/post.php');
require_once($root . 'functions/timeline.php');
require_once($root . 'config/login_required.php');

if(empty($_GET['user_id'])){
    $target_id = $_SESSION['user_id'];
}else{
    $target_id = $_GET['user_id'];
}

$target = getUserFromId($target_id);

if($target == null){
    header('Location: /home');
    exit;
}

$posts = '';

foreach(searchPosts(reply: true, user: $target, amount:100) as $post){
    $posts = $posts . createPost($post->getId(), $_SESSION['user_id']);
}

$picture_id = $target->getPictureId();

if($picture_id != null){
    $icon_path = '/home/icon.php?id=' . $picture_id;
}else{
    $icon_path = 'https://pics.prcm.jp/654b637d854c5/84936407/png/84936407.png';
}

$html = create_page(
    $root . 'templates/user/user_page.html',
    'マイページ',
    [],
    [
        'name' => $target->getName(),
        'icon_path' => $icon_path,
        'following' => $target->getFollowing(),
        'follower' => $target->getFollower(),
        'posts' => $posts
    ]
);

print($html);