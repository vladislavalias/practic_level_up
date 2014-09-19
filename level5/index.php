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

$arrayEmails = $file->getArrayEmails('email/email.txt');
$countEmails = count($arrayEmails);
$result = $parser->statistic(array_slice($arrayEmails, 0, 8000));
$postData = $post->get();

$numberLenght = $calculate->getNumbers($result['lenght'], $postData['lenght'], '=');
$numberFirstSymbol= $calculate->getNumbers($result['firstSymbol'], 
                                           $postData['firstSymbol'], '=');
$numberDomain = $calculate->getNumbers($result['domain'], 
                                       $postData['domain'], '=');
$numberStartDate = $calculate->getNumbers($result['startDate'], 
                                          $postData['startDate'], '>');
$numberStartTime = $calculate->getNumbers($result['startTime'], 
                                          $postData['startTime'], '>');
$numberFinishDate = $calculate->getNumbers($result['finishDate'], 
                                           $postData['finishDate'], '<');
$numberFinishTime = $calculate->getNumbers($result['finishTime'], 
                                           $postData['finishTime'], '<');

require_once 'lib/view.php';
$timeFinish = microtime(true);
$time = $timeFinish - $timeStart;
echo 'Время генерации страницы - '. $time .' секунд <br />';
echo memory_get_usage();