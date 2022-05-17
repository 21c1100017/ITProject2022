<?php

$user_id = 0;

$content = $_POST["content"];

//DB接続

try {
    $db = new PDO(
        "mysql:dbname=sns;host=localhost",
        "root",
        ""
    );
}catch(PDOException $e){
    echo $e;
}

$sql = "INSERT INTO posts (user_id, content) values(?, ?)";

$stmt = $db->prepare($sql);
$res = $stmt->execute(array($user_id, $content));

if($res == true){
    echo "投稿完了";
}else{
    echo "投稿に失敗しました！";
}
