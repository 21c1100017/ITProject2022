<?php
session_start();
require('../db/dbconnect.php');




$html = file_get_contents("");
$html = str_replace("{{}}", $, $html);
$html = str_replace("{{}}", $, $html);

print($html);