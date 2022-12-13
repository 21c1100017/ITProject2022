<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

function check() {
    if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
        //ログインしている
        $_SESSION['time'] = time();
        $db = new database();

        $db->setSQL('SELECT * FROM `users` WHERE id = ?');
        $db->setBindArray([$_SESSION['id']]);
        $db->execute();
        $member = $db->fetch();

        //$follows = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?";
        $db->setSQL('SELECT * FROM `follows` WHERE `from_user_id` = ?');
        $db->setBindArray([$_SESSION['id']]);
        $db->execute();
        $follow = $db->fetchALL();

        $db->setSQL('SELECT * FROM `follows` WHERE `to_user_id` = ?');
        $db->setBindArray([$_SESSION['id']]);
        $db->execute();
        $follower = $db->fetchALL();
    } else {
        //ログインしていない
        header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login/index.php');
        exit;
    }
}
