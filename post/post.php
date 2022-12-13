<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/init.php');

$db = new database();
$user_id = 1;

if(!isset($_SESSION["from_id_set"])):?>


<?php

$db = new database();
$db->setSQL('INSERT INTO `posts` (`user_id`, `from_post_id`, `content`) VALUES (?, ?, ?)');
$db->setBindArray([$user_id, $_SESSION["from_id_set"], $_POST['content']]);
$db->execute();
    
/*

    ここから先 未添削
    
*/

$stmt = $mysql->prepare('SELECT id,user_id,content FROM posts WHERE user_id =1');
$stmt->execute();
$fetch = $stmt->fetchAll(PDO::FETCH_NUM);
?>

<article>
<?php foreach ($fetch as $test) :?>
    <p>返信先>>なし<br><?php print( $test[1])?>( <a class="jump_id" href="reply.php?id=<?php print($test[0]);?>"><?php print( $test[2] );?></a> )</p>
    <?php echo'<br>';?>
</article>    
<?php endforeach; ?>



<?php
elseif(isset($_SESSION["from_id_set"])):?>


<?php
$stmt = $mysql->prepare('INSERT INTO posts SET user_id =1, from_post_id = ?, content =?, created_at =NOW()');
$stmt->execute(array($_SESSION["from_id_set"], $_POST['content']));


    

$stmt = $mysql->prepare('SELECT id,user_id,content,from_post_id FROM posts WHERE user_id =1');
$stmt->execute();
$fetch = $stmt->fetchAll(PDO::FETCH_NUM);
?>"

<article>
<?php foreach ($fetch as $test) :?>
    <p>返信先>><a href=".jump_id"><?php print($test[3])?></a><br><?php print( $test[1])?>( <a class="jump_id" href="reply.php?id=<?php print($test[0]);?>"><?php print( $test[2] );?></a> )</p>
    <?php echo'<br>';?>
</article>    
<?php endforeach; ?>

<?php endif; ?>


</body>
</html>
