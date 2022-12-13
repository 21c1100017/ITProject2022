<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

if(!isset($_POST['content'])){
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/post/reply.php');
    exit;
}

$db = new database();
$user_id = $_SESSION['id'];
$box = '';

if(!isset($_SESSION['from_id_set'])){

    $db = new database();
    $db->setSQL('INSERT INTO `posts` (`user_id`, `from_post_id`, `content`) VALUES (?, ?, ?)');
    $db->setBindArray([$user_id, $_SESSION["from_id_set"], $_POST['content']]);
    $db->execute();

    $db->setSQL('SELECT `id`, `user_id`, `content` FROM `posts` WHERE `user_id` = ?');
    $db->setBindArray([$user_id]);
    $db->execute();
    $fetch = $db->fetchAll();

    foreach($fetch as $test){
        $box = $box . '<p>返信先>>なし<br>' . $test[1] . '<a class="jump_id" href="replay.php"?id="' . $test[0] . '">' . $test[2] . '</a></p><br>';
    }

}else if(isset($_SESSION['from_id_set'])){

    $db->setSQL('INSERT INTO posts (`user_id`, `from_post_id`, `content`) VALUES (?, ?, ?);');
    $db->setBindArray([$user_id, $_SESSION['from_id_set'], $_POST['content']]);
    $db->execute();

    $db->setSQL('SELECT `id`, `user_id`, `content`, `from_post_id` FROM `posts` WHERE `user_id` = ?');
    $db->setBindArray([$user_id]);
    $db->execute();
    $fetch = $db->fetchAll();

    foreach($fetch as $test){
        $box = $box . '<p>返信先>><a href=".jump_id">' . $test[3] . '</a><br>' . $test[1] . '<a class="jump_id" href="replay.php"?id="' . $test[0] . '">' . $test[2] . '</a></p><br>';
    }

}

$html = create_page(
    $root . 'post/templates/post.html',
    '投稿',
    [],
    ['posts' => $box]
);

print($html);
