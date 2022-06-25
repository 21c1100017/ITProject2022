<?php
session_start();
require('../db/dbconnect.php');

$keywords = [
    'member_name' => '',
    'member_picture' => '',
];

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //ログインしている
    $_SESSION['time'] = time();

    $members = $db->prepare('SELECT * FROM members WHERE id=?');
    $members -> execute(array($_SESSION['id']));
    $member = $members -> fetch();
} else {
    //ログインしていない
    header('Location: ../login/index.php');
}

$keywords['member_name'] = $member['name'];
$keywords['member_picture'] = $member['picture'];

//html接続
$html = file_get_contents('./user_page.html');

foreach($keywords as $key => $value) {
    $html = str_replace('{{' . $key . '}}', htmlspecialchars($value, ENT_QUOTES), $html);
}

print($html);

var_dump($member['picture']);

