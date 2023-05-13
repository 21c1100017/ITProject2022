<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/common.php');
require_once($root . 'functions/auth.php');
require_once($root . 'functions/user.php');
require_once($root . 'classes/database.php');

if(isset($_SESSION['user_id'])){
    if(getUserFromId($_SESSION['user_id']) != null){
        header('Location: ' . $root_url . 'home');
        exit;
    }
}

$keywords = [
    'post_email' => '',
    'post_password' => '',
    'password_valid'=> '',
    'err_login_failed' => '',
    'login_css' => $root_url . 'statics/css/login.css',
    'alert' => 'hidden',
    'join_url' => $root_url . 'join'
];

if( isset($_POST['email']) && isset($_POST['password']) ){

    $email = $keywords['post_email'] = $_POST['email'];
    $password = $keywords['post_password'] = $_POST['password'];

    try {
        $sql = "SELECT id FROM users WHERE email = '$email' AND password = '$password';";
        $db = new Database();
        $stmt = $db->bad_query($sql);
        $res = $stmt->fetch();
    } catch(PDOException $e) {
        $res = false;
    }

    if($res == false){
        $keywords['alert'] = '';
        if(isset($e)){
            $keywords['reason'] = $e;
        }else{
            $keywords['reason'] = "ログインに失敗しました！";
        }
        
    }else{
        $_SESSION['user_id'] = $res["id"];
        header('Location: ' . $root_url . 'home');
        exit;
    }
}

$html = create_page(
    $root . 'templates/login/login.html',
    'ログイン',
    [],
    $keywords,
    false
);

print($html);
