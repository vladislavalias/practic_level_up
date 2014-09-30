<!DOCTYPE html>
<html>
  <head>
    <title>Statistic</title>
  </head>
  <body>
    <form action="index.php" method="post">
      Количество эл. адресов:<br />
      Длина имени эл. адреса <input type="number" name="lenght" 
                                    value="<?php echo $postData['lenght'] ?>"> символов: 
      <?php echo $statistic['lenght'] ?><br />
      Первый символ 
      <input type="text" name="firstSymbol" value="<?php echo $postData['firstSymbol']  ?>" maxlength="1">:
      <?php echo $statistic['firstSymbol'] ?><br />
      Домен <input type="text" name="domain" value="<?php echo $postData['domain'] ?>">:
      <?php echo $statistic['domain'] ?><br />
      Активны с <input type="date" name="startDate" value="<?php  echo $postData['startDate'] ?>">:
      <?php echo $statistic['startDate'] ?><br />
      Созданы с <input type="time" name="startTime" value="<?php  echo $postData['startTime'] ?>">:
      <?php echo $statistic['startTime'] ?><br />
      Активны по <input type="date" name="finishDate" value="<?php  echo $postData['finishDate'] ?>">:
      <?php echo $statistic['finishDate'] ?><br />
      Активны до <input type="time" name="finishTime" value="<?php echo $postData['finishTime'] ?>">:
      <?php echo $statistic['finishTime'] ?><br />
      <input type="submit" value="Посчитать">
    </form>
    Количество эл. адресов - <?php echo $statistic['allNumber'] ?><br />
  </body>
</html>

