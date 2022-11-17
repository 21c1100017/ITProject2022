<?php

include_once(__DIR__ . '/../../functions/common/init.php');
include_once(__DIR__ . '/../../functions/common/create.php');
include_once(__DIR__ . '/../../functions/timeline/timeline.php');

$posts = get_posts(10);
$html = create_page(__DIR__ . '/../../../templates/home/home.html', 'ホーム', [], [
    'posts' => $posts
]);

print($html);
