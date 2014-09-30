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
      <?php echo $numberLenght ?><br />
      Первый символ 
      <input type="text" name="firstSymbol" value="<?php echo $postData['firstSymbol']  ?>" maxlength="1">:
      <?php echo $numberFirstSymbol ?><br />
      Домен <input type="text" name="domain" value="<?php echo $postData['domain'] ?>">:
      <?php echo $numberDomain ?><br />
      Активны с <input type="date" name="startDate" value="<?php  echo $postData['startDate'] ?>">:
      <?php echo $numberStartDate ?><br />
      Созданы с <input type="time" name="startTime" value="<?php  echo $postData['startTime'] ?>">:
      <?php echo $numberStartTime ?><br />
      Активны по <input type="date" name="finishDate" value="<?php  echo $postData['finishDate'] ?>">:
      <?php echo $numberFinishDate ?><br />
      Активны до <input type="time" name="finishTime" value="<?php echo $postData['finishTime'] ?>">:
      <?php echo $numberFinishTime ?><br />
      <input type="submit" value="Посчитать">
    </form>
    Количество эл. адресов - <?php echo $countEmails ?><br />
  </body>
</html>

