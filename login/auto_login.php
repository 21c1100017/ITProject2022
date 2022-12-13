<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

//トークン発行
function setLoginToken ($user_id) {

    //重複チェック、データがあったら消去
    if (isset($_COOKIE['token'])) {
        $db = new database();
        $db->setSQL('DELETE FROM `sessions` WHERE token=?;');
        $db->setBindArray([$_COOKIE['token']]);
        $db->execute();
    }

    //テーブルトークン保存
    $db = new database();
    $db->setSQL('INSERT INTO `sessions` (`token`, `user_id`) VALUES(?, ?);');
    $db->setBindArray([
        $_COOKIE['PHPSESSID'],
        $user_id
    ]);
    $db->execute();

    //クッキーへトークンを保存
    setcookie('token',$_COOKIE["PHPSESSID"], time() + 60 * 60 * 24 * 7, '/');

}

//自動ログイン
function auto_login() {

    global $root;
    $db = new database();
    $db->setSQL('SELECT * FROM `sessions` WHERE `token`=?;');
    $db->setBindArray([$_COOKIE['PHPSESSID']]);
    $db->execute();

    //if ($pass = $st->fetch()) { 記述変更
    if ($pass = $db->fetch()){
        //session_regenerate_id(true);
        $_SESSION['id'] = $pass['user_id'];
        $_SESSION['time'] = time();
        header('Location: ../account/user_page.php');
        exit;
    }else{
        header('Location: /account/logout.php');
        exit;
    }
}
