<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'configuration.php';
require_once 'loadMysqlConfig.php';
require_once 'mysql.php';
require_once 'html.php';

$mysqlConfig  = new loadMysqlConfig();
$db           = new mysql($mysqlConfig->load());
$html         = new html();

$result = $db->query('SELECT users.name, users.rating, city.city FROM users LEFT JOIN city ON users.city_id = city.city_id');


echo $html->createTable($result);

function dump($value, $exit = true)
{
  var_dump($value);
  if ($exit) exit();
}
