<?php
require_once('./login/auto_login.php');

if (!empty($_COOKIE['token'])) {
    auto_login();
}else{
    header('Location: ./join' );
}
?>