<?php
session_start();
require('../db/dbconnect.php');
require('./follow.php');



//GETで送ったユーザーネームをセッションに保存

if (isset($_GET['name']) and $_SESSION['username'] != $_GET['name']) {
    $_SESSION['username'] = $_GET['name'];
}

//自分のアカウントの場合ユーザーページに飛ばす

$himselfs = $db->prepare('SELECT * FROM members WHERE id=?');
$himselfs -> execute(array($_SESSION['id']));
$himself = $himselfs -> fetch();

if ($_SESSION['username'] == $himself['name']) {
    header('Location: ./user_page.php');
}

//対象ユーザーの情報をDBから取り出す

$members = $db->prepare('SELECT * FROM members WHERE name=?');
$members -> execute(array($_SESSION['username']));
$member = $members -> fetch();

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


$html = file_get_contents("./o_user.html");
$html = str_replace("{{nam}}", $nam, $html);
$html = str_replace("{{msg}}", $msg, $html);
//$html = str_replace("{{class}}", $class, $html);

print($html);
