<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<?php

require_once('../init.php'); //追加

//require_once("./database.php");   コメントアウト

//session_start();  コメントアウト

$user_id = 1;
if(!isset($_SESSION["from_id_set"])):?>


<?php
//$stmt = $mysql->prepare('INSERT INTO posts SET user_id =1, from_post_id=?, content =?, created_at =NOW()');   コメントアウト
//$stmt->execute(array($_SESSION["from_id_set"], $_POST['content']));   コメントアウト

$db = new database();   //追加
$db->setSQL('INSERT INTO `posts` (`user_id`, `from_post_id`, `content`) VALUES (?, ?, ?)'); //追加
$db->setBindArray([$user_id, $_SESSION["from_id_set"], $_POST['content']]); //追加
$db->execute(); //追加
    
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