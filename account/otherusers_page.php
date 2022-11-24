<?php

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

/*  init.phpに記載済みのため消去。
session_start();
require('../db/dbconnect.php');
*/

require($root . 'account/follow.php');

/*  init.phpに記載済みのため消去
ini_set("error_reporting",0);
*/

//GETで送ったユーザーネームをセッションに保存

if (isset($_GET['name']) and $_SESSION['username'] != $_GET['name']) {
    $_SESSION['username'] = $_GET['name'];
}

//自分のアカウントの場合ユーザーページに飛ばす

/*  databaseクラスを使うため記述変更。
$himselfs = $db->prepare('SELECT * FROM users WHERE id=?');
$himselfs -> execute(array($_SESSION['id']));
$himself = $himselfs -> fetch();
*/

$db = new database();
$db->setSQL('SELECT * FROM `users` WHERE `id`=?;');
$db->setBindArray([$_SESSION['id']]);
$db->execute();
$himself = $db->fetch();

if ($_SESSION['username'] == $himself['name']) {
    header('Location: ./user_page.php');
}

//対象ユーザーの情報をDBから取り出す

/*  databaseクラスを使うため記述変更。
$members = $db->prepare('SELECT * FROM users WHERE name=?');
$members -> execute(array($_SESSION['username']));
$member = $members -> fetch();
*/

$db->setSQL('SELECT * FROM `users` WHERE `name`=?;');
$db->setBindArray([$_SESSION['username']]);
$db->execute();
$member = $db->fetch();

//対象のユーザーをフォローしているか調べる

$which = follow( $member['id'] , $_SESSION['id']);

if($which == false) {
    $msg = "フォローする";
    //$class = "not";
}else{
    $msg = "フォロー解除";
    //$class = "ok";
}

//フォローボタンが押された場合、フォロー処理を行う

if(isset($_POST['follow'])){
    $flinfo = followact($which , $member['id'] , $_SESSION['id']);
    $msg = $flinfo;
}

$nam = $member['name'];

//$class = $flinfo['class'];

/*  create_page関数を使うため記述変更。
$html = file_get_contents("./o_user.html");
$html = str_replace("{{nam}}", $nam, $html);
$html = str_replace("{{msg}}", $msg, $html);
//$html = str_replace("{{class}}", $class, $html);
*/

$html = create_page(
    $root . 'account/templates/o_user.html',
    $nam . 'のページ',
    [],
    [
        'nam' => $nam,
        'msg' => $msg
    ]
);

print($html);
