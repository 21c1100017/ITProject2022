<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

function get_member(string $email){

    $db = new database();
    $db->setSQL('SELECT * FROM `users` WHERE `email` LIKE ?;');
    $db->setBindArray([$_POST['email']]);
    $db->execute();
    $res = $db->fetch();

    return $res;

}

function login(string $email, string $password, bool $auto_login){

    $member = get_member($email);

    if($member == false){
        return false;
    }

    if(password_verify($password, $member['password']) == false){
        return false;
    }

    $_SESSION['id'] = $member['id'];
    $_SESSION['time'] = time();

    if($auto_login){
        setLoginToken($member['id']);
    }

    return true;

}
