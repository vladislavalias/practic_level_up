<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

$timeStart = microtime(TRUE);
require_once 'simple_html_dom.php';
require_once 'parserHtml.php';
require_once 'filter.php';

$parserHtml = new parserHtml();
$filter     = new filter();

if (!isset($_SESSION['arraySites']) || !$_SESSION['arraySites'])
{
  $_SESSION['arraySites'] = $parserHtml->getArrayCites('sputnik', 'гугл', 1);
}
$result     = $filter->getNumberCites($_SESSION['arraySites'], 'google');
var_dump($result);
var_dump($_SESSION['arraySites']);
$timeFinish = microtime(TRUE);

echo $timeFinish - $timeStart;

