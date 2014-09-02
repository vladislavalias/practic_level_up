<?php

class get
{
  /**
   * Получаем номер страницы из ГЕТа
   * @param string $what
   * @return integer
   */
  static function numberPage($what)
  {
    $numberPage = 1;
    if (filter_input(INPUT_GET, $what))
    {
      $numberPage = filter_input(INPUT_GET, $what);
    }
    
    return $numberPage;
  }
}

