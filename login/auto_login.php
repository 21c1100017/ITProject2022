<?php 

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

//require(__DIR__ . '/../db/dbconnect.php'); //init.phpに記載済みなので消去。

//トークン発行
function setLoginToken ($user_id) {

    /*  使用しない為コメントアウト。
    global $db;
    */

    //重複チェック、データがあったら消去
    if (isset($_COOKIE['token'])) {

        /*  databaseクラスを使用するため記述変更。
        $st = $db->prepare('DELETE FROM sessions WHERE token=?');
        $st->execute(array($_COOKIE['token']));
        */

        $db = new database();
        $db->setSQL('DELETE FROM `sessions` WHERE token=?;');
        $db->setBindArray([$_COOKIE['token']]);
        $db->execute();
    }
    //$sta = $db->prepare('DELETE FROM user_token WHERE id=?');
    //$sta->execute(array($user_id));

    //テーブルトークン保存

    /*  databaseクラスを使用するため記述変更。
    $st = $db->prepare('INSERT INTO sessions (token, user_id, created_at) VALUES(?, ?, ?)');
    $st-> execute(array($_COOKIE["PHPSESSID"], $user_id, date('Y-m-d H:i:s')));
    */

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

    /*  使用しないため消去。
    global $db;
    */

    /*  databaseクラスを使用するため記述変更。
    $st = $db->prepare('SELECT * FROM sessions WHERE token=?');
    $st->execute(array($_COOKIE["PHPSESSID"]));
    */

    $db = new database();
    $db->setSQL('SELECT * FROM `sessions` WHERE `token`=?;');
    $db->setBindArray([$_COOKIE['PHPSESSID']]);
    $db->execute();

    //if ($pass = $st->fetch()) { 記述変更
    if ($pass = $db->fetch()){
        session_regenerate_id(true);
        $_SESSION['id'] = $pass['id'];
        $_SESSION['time'] = time();
        header('Location: ../account/user_page.php');
    }
}
