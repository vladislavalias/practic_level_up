<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo memory_get_usage();
$timeStart = microtime(true);
require_once 'lib/file.php';
require_once 'lib/post.php';
require_once 'lib/parser.php';
require_once 'lib/calculate.php';

$file        = new file();
$parser      = new parser();
$post        = new post();
$calculate   = new calculate();

$postData  = $post->get();
$statistic = $parser->statistic($postData, 'email/email.txt');

require_once 'lib/view.php';
$timeFinish = microtime(true);
$time = $timeFinish - $timeStart;
echo 'Время генерации страницы - '. $time .' секунд <br />';
echo memory_get_usage();