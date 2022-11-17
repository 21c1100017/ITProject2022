<?php

require_once(__DIR__ . '/../functions/common/init.php');
require_once(__DIR__ . '/../functions/account/auto_login.php');

if (!empty($_COOKIE['token'])) {
    auto_login();
}else{
    header('Location: ./join');
}
