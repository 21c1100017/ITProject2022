<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

function follow( $follow_id , $follower_id) {

    $db = new database();
    $db->setSQL('SELECT * FROM `follows` WHERE `to_id` = ? and `from_id` = ?;');
    $db->setBindArray([$follow_id, $follower_id]);
    $db->execute();
    $res = $db->fetch();

    //DBにあればそれを、なければFALSEを返す
    return $res;

}

function followact($res , $follow_id , $follower_id) {

    if($res == false){
        //データがない場合
        $sql = 'INSERT INTO `follows` (`to_id`, `from_id`) VALUES (?, ?)';
        $msg = "フォロー解除";
        $class = "not";
    }else{
        //データがある場合
        $sql = 'DELETE FROM `follows` WHERE `to_id` = ? AND `from_id` = ?';
        $msg = "フォローする";
        $class = "ok";
    }

    $db = new database();
    $db->setSQL($sql);
    $db->setBindArray([$follow_id, $follower_id]);
    $db->execute();

    //$returns = array($msg , $class);
    $returns = $msg;
    return $returns;

}
