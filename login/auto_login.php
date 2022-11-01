<?php 
require(__DIR__ . '/../db/dbconnect.php');

//トークン発行
function setLoginToken ($user_id) {
    global $db;
    //重複チェック、データがあったら消去
    if (isset($_COOKIE['token'])) {
        $st = $db->prepare('DELETE FROM user_token WHERE token=?');
        $st->execute(array($_COOKIE['token']));
    }
    //テーブルトークン保存
    $st = $db->prepare('INSERT INTO user_token (token, id, insert_date) VALUES(?, ?, ?)');
    $st-> execute(array($_COOKIE["PHPSESSID"], $user_id, date('Y-m-d H:i:s')));
    //クッキーへトークンを保存
    setcookie('token',$_COOKIE["PHPSESSID"], time() + 60 * 60 * 24 * 7, '/');
}

//自動ログイン
function auto_login() {
    global $db;
    $st = $db->prepare('SELECT * FROM user_token WHERE token=?');
    $st->execute(array($_COOKIE["PHPSESSID"]));
    if ($pass = $st->fetch()) { 
        session_regenerate_id(true);
        $_SESSION['id'] = $pass['id'];
        $_SESSION['time'] = time();
        header('Location: acount/user_page.php');
        exit();
    }
}