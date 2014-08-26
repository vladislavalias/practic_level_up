<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//array(
//   '2014-04-12' => array(
//       '2014-08-19' => array(
//           array('email', 'start_date', 'finish_date')
//       )
//   )
//);


require_once 'lib/emailParser.php';

$parser     = new emailParser();
$parsedData = $parser->getDataFrom('data/email.csv');

if (is_array($parsedData))
{
  var_dump(array_slice($parsedData, 0, 2));
}

