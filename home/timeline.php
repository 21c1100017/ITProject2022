<?php

require_once('../init.php');

/**
 * 
 * 投稿を取得します。
 * 
 * @param int 取得する数を指定します。
 * 
 * @return array 結果を文字列で返します。
 * 
 */
function get_posts(int $amount) : array {

    $db = new database();
    $db->setSQL('SELECT * from `posts`;');
    $db->execute();
    $posts = $db->fetchAll();

    return $posts;

}
