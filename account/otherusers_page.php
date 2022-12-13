<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once($root . 'account/follow.php');

//GETで送ったユーザーネームをセッションに保存
if (isset($_GET['name']) and $_SESSION['username'] != $_GET['name']) {
    $_SESSION['username'] = $_GET['name'];
}

//自分のアカウントの場合ユーザーページに飛ばす
$db = new database();
$db->setSQL('SELECT * FROM `users` WHERE `id`=?;');
$db->setBindArray([$_SESSION['id']]);
$db->execute();
$himself = $db->fetch();

if ($_SESSION['username'] == $himself['name']) {
    header('Location: ./user_page.php');
}

//対象ユーザーの情報をDBから取り出す
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
