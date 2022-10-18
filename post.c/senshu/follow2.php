<?php

//require_once("./database.php");
require('../db/dbconnect.php');


session_start();

$follow_id = 1;
$follower_id = 2;

$sql = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?;";
$stmt = $mysql->prepare($sql);
$stmt->execute(array($follow_id, $follower_id));
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res == false){
    //データがない場合
}else{
    //データがある場合
}

if(isset($_POST["follow"])){
    if($_SESSION["follow"]){
        $_SESSION["follow"] = false;
    }else{
        $_SESSION["follow"] = true;
    }
}

if($_SESSION["follow"]){
    $msg = "フォロー解除";
}else{
    $msg = "フォローする";
}

$html = file_get_contents("./follow.html");
$html = str_replace("{{msg}}", $msg, $html);

print($html);
var_dump($_SESSION);
exit;
