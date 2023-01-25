<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/post.php');
require_once($root . 'functions/timeline.php');
require_once($root . 'config/login_required.php');

if(empty($_GET['post_id'])){
    header('Location: ' . $root_url . '/home');
    exit;
}

$post = getPost($_GET['post_id']);
$author = $post->getUser();

$html = create_page(
    $root . 'templates/home/detail.html',
    '詳細',
    [],
    [
        'icon_path' => '/home/icon.php?id=' . $author->getPicture(),
        'name' => $author->getName(),
        'created_at' => getFormattedCreatedAt($post->getId()),
        'content' => $post->getContent()
    ]
);

print($html);
