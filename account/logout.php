<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

$_SESSION = array();

if (isset($_COOKIE[session_name()])) {
    //セッションクッキー削除
    setcookie(session_name(), '', time() - 42000, '/');
}
//トークン削除
setcookie('token', '', time() - 42000, '/');
//セッション削除
session_destroy();
header('Location: ../login/index.php');
