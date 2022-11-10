<?php
require_once('../functions/common/init.php');
require_once('../functions/account/auto_login.php');

if (!empty($_COOKIE['token'])) {
    auto_login();
}else{
    header('Location: ./join');
}
