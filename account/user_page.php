<?php

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

/*  init.phpに記載済みなので消去。
session_start();
require('../db/dbconnect.php');
*/

$keywords = [
    'member_name' => '',
    'member_picture' => '',
    'follow' => '',
    'follower' => '',
];

if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
    //ログインしている
    $_SESSION['time'] = time();

    /*  databaseクラスを使用するため記述変更。
    $members = $db->prepare('SELECT * FROM users WHERE id=?');
    $members -> execute(array($_SESSION['id']));
    $member = $members -> fetch();
    */

    $db = new database();
    $db->setSQL('SELECT * FROM `users` WHERE `id`=?;');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $member = $db->fetch();

    /*  databaseクラスを使用するため記述変更。
    //$follows = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?";
    $follows = $db->prepare('SELECT * FROM follows WHERE from_user_id = ?');
    $follows->execute(array($_SESSION['id']));
    $follow = $follows->fetchALL();
    */

    $db->setSQL('SELECT * FROM `follows` WHERE `from_id` = ?');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $follow = $db->fetchAll();

    /* databaseクラスを使用するため記述変更。
    $followers = $db->prepare('SELECT * FROM follows WHERE to_user_id = ?');
    $followers->execute(array($_SESSION['id']));
    $follower = $followers->fetchALL();
    */

    $db->setSQL('SELECT * FROM `follows` WHERE `to_id` = ?;');
    $db->setBindArray([$_SESSION['id']]);
    $db->execute();
    $follower = $db->fetchAll();

} else {
    //ログインしていない
    header('Location: ../login/index.php');
    exit;
}

$ext = substr($member['picture'] , -3);

if($ext == 'jpg' or $ext == 'gif') {
    //$keywords['member_picture'] = $member['picture'];?>
    <img src="../member_picture/<?php echo($member['picture']);?>" height="200" width="200">
<?php
}

$keywords['member_name'] = $member['name'];
//$keywords['member_picture'] = $member['picture'];

$keywords['follow'] = count($follow);
$keywords['follower'] = count($follower);

/*  create_page関数を使用するため記述変更。
//html接続
$html = file_get_contents('./user_page.html');

foreach($keywords as $key => $value) {
    $html = str_replace('{{' . $key . '}}', htmlspecialchars($value, ENT_QUOTES), $html);
}
*/

$html = create_page(
    $root . 'account/templates/user_page.html',
    'ユーザーページ',
    [],
    $keywords
);

print($html);

//var_dump($follow);
//var_dump($_SESSION['id']);
//var_dump($member['picture']);
