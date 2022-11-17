<?php

include_once(__DIR__ . '/../common/database.php');

/**
 * 
 * 投稿を取得します。
 * 
 * @param int 取得する数を指定します。
 * 
 * @return string 結果を文字列で返します。
 * 
 */
function get_posts(int $amount) : string {

    $db = new database();
    $db->setSQL('SELECT * from `posts`;');
    $db->execute();
    $posts = $db->fetchAll();

    return $posts;

}
