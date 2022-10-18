
<?php



require_once("./database.php");

session_start();

$follow_id = 1;
$follower_id = 2;

//follow_idとfollwer_idのカラムをfollowテーブルから取ってくる
$sql = "SELECT * FROM `follow` WHERE `follow_id` = ? and `follower_id` = ?;";
$stmt = $mysql->prepare($sql);
$stmt->execute(array($follow_id, $follower_id));
$res = $stmt->fetch(PDO::FETCH_ASSOC);

$bgColor = ''; // 背景色
$color   = ''; // 文字色

if($res == false){
    $msg = "フォローする";
}else{
    $msg = "フォロー解除";
}

if(isset($_POST['follow'])){

    if($res == false){
        //データがない場合
        $sql = 'INSERT INTO `follow` (`follow_id`, `follower_id`) VALUES (?, ?)';
        $msg = "フォロー";
        $class = "not";
        
    }else{
        //データがある場合
        $sql = 'DELETE FROM `follow` WHERE `follow_id` = ? AND `follower_id` = ?';
        $msg = "フォロー解除";
        $class = "ok";
    }
    
    $stmt = $mysql->prepare($sql);
    $stmt->execute([$follow_id, $follower_id]);

}

$html = file_get_contents("./follow.html");
$html = str_replace("{{msg}}", $msg, $html);
$html = str_replace("{{class}}", $class, $html);

print($html);
exit;
