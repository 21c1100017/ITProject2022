<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

if(isset($_GET['id'])){
    $id_number = $_GET['id'];
}

$_SESSION['from_id_set'] = $id_number;

$db = new database();
$db->setSQL('SELECT `content` FROM `posts` WHERE `id` = ?');
$db->setBindArray([$id_number]);
$db->execute();
$content = $db->fetch();

$html = create_page(
    $root . 'post/templates/reply.html',
    '返信',
    [],
    [
        'content' => $content[0]
    ]
);

print($html);
