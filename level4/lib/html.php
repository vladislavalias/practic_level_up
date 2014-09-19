<?php $view = new view() ?>

<!DOCTYPE html>
<html>
    <head>
        <title>EmailParser</title>
    </head>
    <body>
        <form method="post" action="./index.php">
          Длина эл. почты: 
          <input type="text"   name="lenght" maxlength="2" 
                 value="<?php echo $postData['lenght'] ?>"> <br />
          Первый символ адреса:
          <input type="text" name="firstSymbol" maxlength="1" 
                 value="<?php echo $postData['firstSymbol'] ?>"> <br />
          Домен:
          <input type="text" name="domain" maxlength="16" 
                 value="<?php echo $postData['domain'] ?>"> <br />
          Начальная дата:
          <input type="date" name="startDate" 
                 value="<?php echo $postData['startDate'] ?>"> <br />
          Начальное время:
          <input type="time" name="startTime" 
                 value="<?php echo $postData['startTime'] ?>"> <br /> 
          Конечная дата:
          <input type="date" name="finishDate" 
                 value="<?php echo $postData['finishDate'] ?>"> <br />
          Конечное время:
          <input type="time" name="finishTime" 
                 value="<?php echo $postData['finishTime'] ?>"> <br />
          <input type="submit">
        </form>
      Результат:(первые 20 значений)<br />
      <?php $view->show($result) ?>
    </body>
</html>
