<?php

	require_once('./init.php');
	require_once($root . 'login/auto_login.php');

	if(!empty($_COOKIE['token'])){
		auto_login();
	}else{
		header('Location: ./login');
		exit;
	}
