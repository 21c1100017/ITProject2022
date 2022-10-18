<?php
session_start();
require('../db/dbconnect.php');

$user_name = $_GET['name'];

$members = $db->prepare('SELECT * FROM members WHERE name=?');
$members -> execute(array($user_name));
$member = $members -> fetch();

echo($member['name']);

//var_dump($_GET['name']);