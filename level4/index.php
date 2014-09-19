<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$startTime = microtime(TRUE);

require_once 'lib/emailParserUpgrade.php';
require_once 'lib/view.php';
require_once 'lib/post.php';
require_once 'lib/paginator.php';
require_once 'lib/get.php';

$post    = new post();
$parser  = new emailParserUpgrade();

$postData = $post->get();
$parsedArray = $parser->getParsedEmail('email/email.txt');

$result = $parser->getValueFromMultyArray($parsedArray, $postData);


//$parsedData = $parser->toShow('email/email.txt', 
//              post::saveToSessionAndShow('date', 'start'), 
//              post::saveToSessionAndShow('date', 'finish'));
require_once 'lib/html.php';
$endTime = microtime(TRUE);

$time = $endTime - $startTime;

echo sprintf('Время генерации страницы - %.4f секунд', $time);