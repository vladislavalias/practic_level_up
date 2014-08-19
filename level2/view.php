<?php

$html = new html();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Clicker</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="main">
            <?php if (!$_SESSION['login']): ?>
            <h1>Clicker</h1><br />
            <?php echo $html->form(templates::$arrayFormElements) ?>
            <?php else: ?>
            <h3>Рейтинг лучших кликеров:</h3>
            <?php $result = $db->query('SELECT users.name, users.rating, '
                    . 'city.city FROM users LEFT JOIN city ON users.city_id = city.id ORDER BY rating DESC');
                  echo $html->createTable($result);
                  echo $html->form(templates::$arrayFormElementsClick, 'Накликай рейтинг!') ?>
                  <a href="index.php?exit=1">Выйти</a>
            <?php endif; ?>
        </div>
    </body>
</html>