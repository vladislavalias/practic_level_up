<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

require_once 'lib/lib.php';
$mysqlConfig  = new loadMysqlConfig();
$db           = new mysql($mysqlConfig->load());
$post = filter_input_array(INPUT_POST);
if (!isset($_SESSION['login']))
{
    $_SESSION['login'] = '';
}
if (filter_input(INPUT_GET, 'exit'))
{
    $_SESSION['login'] = '';
    header('Location: index.php');
}

if (isset($post['auth']))
{
    $query = sprintf('SELECT `name` FROM users WHERE name=\'%s\' AND password=%s', $post['auth']['login'], $post['auth']['password']);
    $_SESSION['login'] = $db->query($query) ? $post['auth']['login'] : false;
    if (!$_SESSION['login'])        echo 'Неправильный логин или пароль';
}
if (isset($post['Click']))
{
    $query = sprintf('UPDATE `users` set rating=rating+%d WHERE name=\'%s\'', 1, $_SESSION['login']);
    $db->query($query);
}

require_once 'view.php';


