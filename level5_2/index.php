<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$start = microtime(TRUE);
require_once 'lib/parser.php';

$parser = new parser();

$statistic = $parser->statistic('email/email.txt');

$finish = microtime(TRUE);
$time = $finish - $start;
echo $time;
var_dump($statistic);
