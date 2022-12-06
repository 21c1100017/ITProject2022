<?php

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

/*  init.phpに記載済みなので消去。
session_start();
require('../db/dbconnect.php');
*/

require('./auto_login.php');

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

//エラー発生フラグ
$error = false;

//var_dump($_POST);
//exit;

if (!empty($_POST)) {
    //ログインの処理
    if($_POST['email'] != '' && $_POST['password'] != '') {

        /*  databaseクラスを使うため記述変更。
        $login = $db->prepare('SELECT * FROM users WHERE email=? ');
        $login->execute(array(
            $_POST['email']
        ));
        $member = $login->fetch();
        */

        $db = new database();
        $db->setSQL('SELECT * FROM `users` WHERE `email`=?;');
        $db->setBindArray([$_POST['email']]);
        $db->execute();
        $member = $db->fetch();

        if (password_verify($_POST['password'],$member['password'])) {
            $keywords['Password_valid'] = true;
        }
            //ログイン成功時
            if($keywords['Password_valid']) {
                $_SESSION['id'] = $member['id'];
                $_SESSION['time'] = time();

                    //ログイントークンの生成
                    if ($_POST['save'] == 'on') {
                        setLoginToken($member['id']);
                    }
                //session_regenerate_id(true);
                header('Location: ../account/user_page.php');
                exit();
            } else {
                $error['login'] = 'failed' ;
            }
    } else {
        $error['login'] = 'blank' ;
    }
}

//エラー処理
if (!empty($error)){
    $keywords['post_email'] = $_POST['email'] ;
    $keywords['post_password'] = $_POST['password'] ;

    if ($error['login'] == 'failed') {
        $keywords['err_failed'] = 'ログインに失敗しました。正しくご記入ください。';
    }
    if ($error['login'] == 'blank') {
        $keywords['err_failed'] = 'メールアドレスとパスワードをご記入ください';
    }
} 

/*  create_page関数を使うため記述変更。
//html接続
$html = file_get_contents('./login.html');

foreach($keywords as $key => $value) {
    $html = str_replace('{{' . $key . '}}', htmlspecialchars($value, ENT_QUOTES), $html);
}
*/

$html = create_page(
    $root . 'login/templates/login.html',
    'ログイン',
    [],
    $keywords
);

print($html);
