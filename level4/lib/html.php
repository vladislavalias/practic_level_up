<?php $view = new view() ?>

<!DOCTYPE html>
<html>
    <head>
        <title>EmailParser</title>
    </head>
    <body>
        Выберите дату активности email<br />
        <form method="post" action="./index.php">
            C 
            <input type="text" name="date[start]" value="<?php echo post::saveToSessionAndShow('date', 'start') ?>">
            по
            <input type="text" name="date[finish]" value="<?php echo post::saveToSessionAndShow('date', 'finish') ?>">
            (в формате гггг-мм-дд). <br />
            <input type="submit">
        </form>
        Результат:<br />
        <?php echo $view->show(
                array_slice(
                        $parsedData, 
                        (get::numberPage('page') - 1) * 10,
                        10
                )
              ) ?>
        <?php echo paginator::show(paginator::pages($parsedData, 10)) ?>
    </body>
</html>
