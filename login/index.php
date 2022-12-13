<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');
require_once($root . 'login/login.php');
require_once($root . 'login/auto_login.php');

if (!empty($_COOKIE['token'])) {
    auto_login();
}

//配列　定義
$keywords = [
    'post_email' => '',
    'post_password' => '',
    'Password_valid'=> '',
    'err_faloginiled' => '',
    'err_failed' => ''
];

if(isset($_POST['email']) && isset($_POST['password'])){

    $keywords['post_email'] = $_POST['email'];
    $keywords['post_password'] = $_POST['password'];

    if(isset($_POST['save'])){
        $res = login($_POST['email'], $_POST['password'], true);
    }

    $res = login($_POST['email'], $_POST['password'], false);

    if($res){
        header('Location: ../account/user_page.php');
        exit;
    }else{
        $keywords['err_faloginiled'] = 'メールアドレス または パスワードが間違っています。';
        $keywords['err_failed'] = 'メールアドレス または パスワードが間違っています。';
    }
}

$html = create_page(
    $root . 'login/templates/login.html',
    'ログイン',
    [],
    $keywords
);

print($html);
