<?php

class html
{
  protected $attr = 'border="1"';
  const openTag = '<';
  const openClosingTag = '</';
  const closeTag = '>';
  const table = 'table';
  const input = 'input';
  const form = 'form';
  const post = 'post';
  const br = '<br />';
  
  /**
   * Формирование формы отправкеи данных на основании массива данных
   * 
   * @param array $formElements
   * @param string $submitName
   * @param string $where
   * @return string
   */
  public function form($formElements, $submitName = 'Отправить', $where = 'index.php')
  {
      $form = self::openTag . self::form . ' action="'.$where.'" method="'.self::post.'"'.self::closeTag;
      foreach ($formElements as $formElement)
      {
          if ($formElement['type'] == 'password')
          {
              $value = '';
          }
          elseif ($formElement['type'] == 'submit')
          {
              $value = $submitName;
          }
          else
          {
              $value = filter_input(INPUT_POST, $formElement['name']);
          }
          
          $form .= self::openTag . self::input . ' name="'.$formElement['name'].'"'.
                  ' type="'.$formElement['type'].'"'.
                  ' value="'.$value.'"'.self::closeTag.self::br;
      }
      $form .= self::openClosingTag . self::form . self::closeTag;
      
      return $form;
  }
  
   /**
   * Формирование блоков таблицы на основании двумерного массива
   * 
   * @param array $arrayParam
   * @param string $elementTable
   */
  // гибко как кирпич, блин
  protected function getTableBlocs($arrayParam, $elementTable = 'tr')
  {
    $table = '';

    foreach ($arrayParam as $key => $param)
    {
      $n[1] = (!isset($n[1])) ? 1 : $n[1];
      if (is_array($param))
      {
        $table .= self::openTag.$elementTable.self::closeTag;
        $table .= $this->getTableBlocs($n, 'td');
        $table .= $this->getTableBlocs($param, 'td');
        $table .= self::openClosingTag.$elementTable.self::closeTag;
      }
      elseif (is_int($key))
      {
        $param = $_SESSION['login'] == $param ? '<b>'.$param.'</b>(это Вы)' : $param;
        $table .= self::openTag.$elementTable.self::closeTag;
        $table .=  $param ;
        $table .= self::openClosingTag.$elementTable.self::closeTag;
      }
      $n[1]++;
    }
    return $table;
  }
  
  public function createTable($tableBlocs)
  {
    return self::openTag.self::table.' '.$this->attr.self::closeTag.  
            $this->getTableBlocs($tableBlocs).self::openClosingTag.
            self::table.self::closeTag;
  }
}

