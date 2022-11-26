<?php

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

//session_start();

/*  init.phpに記載済みなので消去。
require_once("../db/dbconnect.php");
*/

function follow( $follow_id , $follower_id) {
    /*
    global $db;
    /*

    //follow_idとfollwer_idのカラムをfollowテーブルから取ってくる

    /*  databaseクラスを使うため記述変更。
    $sql = "SELECT * FROM `follows` WHERE `to_user_id` = ? and `from_user_id` = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($follow_id, $follower_id));
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    */

    $db = new database();
    $db->setSQL('SELECT * FROM `follows` WHERE `to_id` = ? and `from_id` = ?;');
    $db->setBindArray([$follow_id, $follower_id]);
    $db->execute();
    $res = $db->fetch();

    //DBにあればそれを、なければFALSEを返す
    return $res;

}
    
    
function followact($res , $follow_id , $follower_id) {

    /*  使用しないためコメントアウト。
    global $db;
    */

    if($res == false){
        //データがない場合

        $sql = 'INSERT INTO `follows` (`to_user_id`, `from_user_id`) VALUES (?, ?)';
        $msg = "フォロー解除";
        $class = "not";

    }else{
        //データがある場合
        $sql = 'DELETE FROM `follows` WHERE `to_user_id` = ? AND `from_user_id` = ?';
        $msg = "フォローする";
        $class = "ok";

    }

    /*  databaseクラスを使うため記述変更。
    $stmt = $db->prepare($sql);
    $stmt->execute([$follow_id, $follower_id]);
    */

    $db = new database();
    $db->setSQL($sql);
    $db->setBindArray([$follow_id, $follower_id]);
    $db->execute();

    //$returns = array($msg , $class);
    $returns = $msg;

    return $returns;

}