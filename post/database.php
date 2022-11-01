<?php

$db_name = "WIP";
$db_user = "admin";
$db_host = "localhost";
$db_passworrd = "admin";

try{
    $mysql = new PDO(
        "mysql:host=" .$db_host . ";dbname=" .$db_name,
        $db_user,
        $db_passworrd
    )

}catch(\PDOException $e)