<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config/init.php');
require_once($root . 'functions/post.php');
// require_once($root . 'config/login_required.php');

$user = getUserFromId($_SESSION['user_id']);

/* if(!$user->isAdmin()){
    header('Location: /');
    exit;
} */

if(isset($_GET['id'])){
    deletePost(getPost($_GET['id']));
}

header('Location: /admin');
exit;
