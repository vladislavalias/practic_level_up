<?php
try
{
$db = new PDO('mysql:host=localhost;dbname=test_classes');
  echo "Connected<p>";
}
catch (Exception $e)
{
  echo "Unable to connect: " . $e->getMessage() ."<p>";
}


try
{
  $stmt       = $db->query('SELECT users.name, users.rating, city.city FROM `users` '
          . 'LEFT JOIN `city` ON users.city_id = city.city_id ORDER BY rating DESC');
  $result     = $stmt->fetchAll();
}
catch(PDOException $e)
{
  echo 'Error : '.$e->getMessage();
  exit();
}

var_dump($result);

