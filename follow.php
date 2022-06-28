<?php

require_once("./database.php");

session_start();

if(!isset($_SESSION["follow"])){
    $_SESSION["follow"] = false;
}

if(isset($_POST["follow"])){
    if($_SESSION["follow"]){
        $_SESSION["follow"] = false;
    }else{
        $_SESSION["follow"] = true;
    }
}

if($_SESSION["follow"]){
    $msg = "フォロー解除";
}else{
    $msg = "フォローする";
}

$html = file_get_contents("./follow.html");
$html = str_replace("{{msg}}", $msg, $html);

print($html);
var_dump($_SESSION);
exit;
