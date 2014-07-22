<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'lib/test.class.php';

//var_dump(test::$staticOne);
//var_dump(test::CONST_ONE);

Singleton::getInstance()->text = '1234567890-=-0987654321234567uikvsfioiuhxdtukv8itugfj';

$test = new test();
$test->public = ' fgghjhg';
var_dump($test);
var_dump($test->getPrivate('sdfsdf', 'lkhgjhfg'));

Singleton::getInstance()->doAction();