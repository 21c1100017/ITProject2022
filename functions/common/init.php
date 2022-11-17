<?php

session_start();
$config = include(__DIR__ . '/../../config/config.php');

if($config['DEBUG_MODE'] == true){
    ini_set('display_errors', 0);
}else{
    ini_set('display_errors', 1);
}
