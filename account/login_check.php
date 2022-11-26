<?php
require_once("../db/dbconnect.php");

function check() {
    global $db;
    session_start();
    if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
        //ログインしている
        $_SESSION['time'] = time();
    
        $members = $db->prepare('SELECT * FROM users WHERE id=?');
        $members -> execute(array($_SESSION['id']));
        $member = $members -> fetch();
    
        //$follows = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?";
        $follows = $db->prepare('SELECT * FROM follows WHERE from_user_id = ?');
        $follows->execute(array($_SESSION['id']));
        $follow = $follows->fetchALL();
    
        $followers = $db->prepare('SELECT * FROM follows WHERE to_user_id = ?');
        $followers->execute(array($_SESSION['id']));
        $follower = $followers->fetchALL();
    } else {
        //ログインしていない
        header('Location: ../login/index.php');
    }
}