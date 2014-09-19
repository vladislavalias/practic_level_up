<?php

class view
{
    public function show($array)
    {
      if ($array)
      {
        $arrayDataEmails = array_slice($array, 0, 20);
        foreach ($arrayDataEmails as $arrayDataEmail)
        {
          echo $arrayDataEmail.'<br />';
        }
      }
      else
      {
        echo 'Ничего не найдено. Измените параметры запроса.<br />';
      }
      echo '<br />';
    }
}

