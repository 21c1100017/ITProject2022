<?php

require_once("./database.php");

session_start();

$post_id = 1;

$insert = "INSERT INTO 'posts'(comments) VALUE(:comments)";
$sql = "SELECT content FROM 'posts' ";
$stmt = $mysql->prepare($insert);
$param = $array(":comments" => $_POST["comments"]);
$stmt->exewcute($param);


