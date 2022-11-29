<?php

require_once('../init.php');
require_once('./timeline.php');

$timeline = get_posts(10);

print($timeline);
