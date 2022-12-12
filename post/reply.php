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

//if(!isset($_SESSION)){ session_start(); } コメントアウト
if(isset($_GET['id'])) { $id_number = $_GET['id']; } 
$_SESSION['from_id_set'] = $id_number;

//$stmt = $mysql->prepare("SELECT content FROM posts WHERE id=$id_number"); コメントアウト
//$stmt ->execute();    コメントアウト

$db = new database(); //追加
$db->setSQL('SELECT `content` FROM `posts` WHERE `id` = ?'); //追加
$db->setBindArray([$id_number]); //追加
$db->execute(); //追加
$content = $db->fetch(); //追加

?>

<article>
<?php foreach($stmt as $set): ?>
    <p><?php print( $set[0]) ?></p>
</article>
<?php endforeach; ?>

<form action="post.php" method = "post" >
    <textarea name="content"  cols="50" rows="10" placeholder="コメントしてください"></textarea>
    <br>
    <input type="submit"value="返信"><input type="reset"value="リセット">
</form>


</body>
</html>

<!--
</body> コメントアウト
</html> コメントアウト
-->
