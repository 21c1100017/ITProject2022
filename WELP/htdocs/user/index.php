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

$html = create_page(
    $root . 'templates/user/user_page.html',
    'マイページ',
    [],
    [
        'name' => $target->getName(),
        'icon_path' => $target->getPictureUrl(),
        'following' => $target->getFollowing(),
        'follower' => $target->getFollower(),
        'posts' => $posts
    ],
    icon_path: getUserFromId($_SESSION['user_id'])->getPictureUrl()
);

print($html);