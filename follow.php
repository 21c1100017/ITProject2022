<?php

require_once("./database.php");

session_start();

$follow_id = 1;
$follower_id = 2;

//follow_idとfollwer_idのカラムをfollowテーブルから取ってくる
$sql = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?;";
$stmt = $mysql->prepare($sql);
$stmt->execute(array($follow_id, $follower_id));
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res == false){
    $msg = "フォローする";
}else{
    $msg = "フォロー解除";
}

if(isset($_POST['follow'])){

    if($res == false){
        //データがない場合
        $sql = 'INSERT INTO `follow` (`follow_id`, `follower_id`) VALUES (?, ?)';
        $msg = "フォロー解除";
    }else{
        //データがある場合
        $sql = 'DELETE FROM `follow` WHERE `follow_id` = ? AND `follower_id` = ?';
        $msg = "フォローする";
    }

    $stmt = $mysql->prepare($sql);
    $stmt->execute([$follow_id, $follower_id]);

}

$html = file_get_contents("./follow.html");
$html = str_replace("{{msg}}", $msg, $html);

print($html);
exit;
