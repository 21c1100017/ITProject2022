<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

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
