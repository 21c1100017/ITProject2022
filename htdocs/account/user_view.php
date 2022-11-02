<?php
session_start();
require('../db/dbconnect.php');

$acounts = $db->query('SELECT * FROM members ORDER BY id DESC');
?>

<article>
    <?php while ( $acount = $acounts -> fetch()): ?>
        <p><a href="otherusers_page.php?name=<?php print($acount['name']); ?>"><?php print($acount['name']); ?></a></p>
</article>
<?php endwhile; ?>

<a href="./user_page.php">ユーザーページに戻る</a>