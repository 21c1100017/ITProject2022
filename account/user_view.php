<?php

require_once('../init.php'); //最初に読み込む必須ファイルを追加。

/*  init.phpに記載済みなので消去。
session_start();
require('../db/dbconnect.php');
*/

/*  databaseクラスを使用するため記述変更。
$accounts = $db->query('SELECT * FROM users ORDER BY id DESC');
*/

$db = new database();
$db->setSQL('SELECT `name` FROM `users` ORDER BY `id` DESC;');
$db->execute();

?>

<article>
    <?php
        /*
         while ( $account = $accounts -> fetch()): 
        */
        while($account = $db->fetch()):
        ?>
        <p><a href="otherusers_page.php?name=<?php print($account['name']); ?>"><?php print($account['name']); ?></a></p>
</article>
<?php endwhile; ?>

<a href="./user_page.php">ユーザーページに戻る</a>
