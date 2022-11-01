<?php

require_once("../db/dbconnect.php");

if(isset($_GET["confirm"])){
    $file = fopen("./students.csv", "r");
    try {
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->beginTransaction();
        while($line = fgetcsv($file)){
            $stmt = $db->prepare("INSERT INTO `members` (`name`, `email`, `password`, `picture`) VALUES (?, ?, ?, ?);");
            $stmt->execute([$line[0], $line[1], password_hash($line[2], PASSWORD_BCRYPT), ""]);
        }
        $db->commit();
    } catch(Exception $e) {
        $db->rollBack();
        fclose($file);
        echo "エラーが発生したため、処理はキャンセルされました。<br>";
        echo "エラー内容：";
        echo $e->getMessage();
        exit;
    }
    fclose($file);
    echo "正常にインポートされました。";
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>大量データインポート</title>
    <style>
        * {
            text-align: center;
        }
        p {
            margin-top: 20vh;
        }
    </style>
</head>
<body>
    <p>1000人分のデータを挿入します。よろしいですか？</p>
    <a href="?confirm=true"><button>はい</button></a>
    <a href="../"><button>いいえ</button></a>
</body>
</html>
