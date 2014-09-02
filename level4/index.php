<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


require_once 'lib/emailParser.php';
require_once 'lib/view.php';
require_once 'lib/post.php';
require_once 'lib/paginator.php';
require_once 'lib/get.php';

$parser     = new emailParser();
$parsedData = $parser->toShow('email/email.txt', 
              post::saveToSessionAndShow('date', 'start'), 
              post::saveToSessionAndShow('date', 'finish'));
require_once 'lib/html.php';
