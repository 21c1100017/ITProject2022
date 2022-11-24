<?php

session_start();

global $root;
$root = $_SERVER['DOCUMENT_ROOT'] . '/';

if((require($root . 'config.php'))['DEBUG_MODE'] == false){
    ini_set('display_errors', false);
}else{
    ini_set('display_errors', true);
}

require_once($root . 'classes.php');
require_once($root . 'functions.php');
