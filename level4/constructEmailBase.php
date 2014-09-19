<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'email/construct.php';
require_once 'email/writeData.php';

$construct = new construct();
$write = new writeData();

$emailString = $construct->emailDateString(30000);
$write->write('email/email.txt', $emailString);

//$handle = fopen('email/email.txt', 'a');
//for ($i = 0; $i < 29999; $i++)
//{
//  $randomString = randomString();
//  $startDate = setDateAvailable();
//  $finishDate = setDateAvailable();
//  isSecondDateBigger($startDate, $finishDate) ? 
//  fwrite($handle, $randomString.' '.$startDate.' '.$finishDate."\r\n") :
//  fwrite($handle, $randomString.' '.$finishDate.' '.$startDate."\r\n");
//}
//fclose($handle);
//
//function randomString()
//{
//  $availableSymbols = '1234567890abcdefghijklnmopqrstuvwxyz';
//  $availableEmail   = array('yandex.ua', 'google.com', 'i.ua');
//  $name = '';
//  $lenght = mt_rand(3, 15);
//  for ($i = 0; $i < $lenght; $i++)
//  {
//    $rand = mt_rand(0, strlen($availableSymbols) - 1);
//    $name .= $availableSymbols[$rand];
//  }
//  $rand = mt_rand(0, count($availableEmail) - 1);
//  $email = $availableEmail[$rand];
//  $result = $name.'@'.$email;
//  return $result;
//}
//
//function setDateAvailable()
//{
//  $templateYears   = array('2010', '2011', '2012', '2013');
//  $templateDate = array(
//  '01' => 31, 
//  '02' => 28, 
//  '03' => 31, 
//  '04' => 30,
//  '05' => 31, 
//  '06' => 30, 
//  '07' => 31,
//  '08' => 31, 
//  '09' => 30, 
//  '10' => 31,
//  '11' => 30,
//  '12' => 31
//  );
//  
//  $randKey = array_rand($templateYears);
//  $date = $templateYears[$randKey].'-';
//  $randKey = array_rand($templateDate);
//  $date .= $randKey.'-';
//  $day = mt_rand(1, $templateDate[$randKey]);
//  if (strlen($day) == 1)
//  {
//    $date .= 0 . $day;
//  }
//  else
//  {
//    $date .= $day;
//  }
//  return $date;
//}
//
//function isSecondDateBigger($date1, $date2)
//{
//  $number1 = str_replace('-', '', $date1);
//  $number2 = str_replace('-', '', $date2);
//  if ($number2 > $number1)
//  {
//    return TRUE;
//  }
//}