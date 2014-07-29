<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'mysql.php';
require_once 'html.php';

$db = new mysql();
$html = new html();

$result = $db->query('SELECT users.name, users.rating, city.city FROM users LEFT JOIN city ON users.city_id = city.city_id');


echo $html->createTable($result);

function dump($value, $exit = false)
{
  var_dump($value);
  if ($exit) exit();
}