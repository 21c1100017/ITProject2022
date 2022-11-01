<?php
//session_start();
require_once("../db/dbconnect.php");

function follow( $follow_id , $follower_id) {
    global $db;
    //follow_idとfollwer_idのカラムをfollowテーブルから取ってくる
    $sql = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($follow_id, $follower_id));
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    //DBにあればそれを、なければFALSEを返す
    return $res;
}
    
    
function followact($res , $follow_id , $follower_id) {
    global $db;
    if($res == false){
        //データがない場合
        $sql = 'INSERT INTO `follow` (`follow_id`, `follower_id`) VALUES (?, ?)';
        $msg = "フォロー解除";
        $class = "not";
            
    }else{
        //データがある場合
        $sql = 'DELETE FROM `follow` WHERE `follow_id` = ? AND `follower_id` = ?';
        $msg = "フォローする";
        $class = "ok";
        
    }       
        $stmt = $db->prepare($sql);
        $stmt->execute([$follow_id, $follower_id]);    
        //$returns = array($msg , $class);
        $returns = $msg;
        return $returns;
}