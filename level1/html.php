<?php

class html
{
  
  protected $attr = 'border="1"';
  protected $openTag = '<';
  protected $closeTag = '>';
  /**
   * Формирование блоков таблицы на основании одно- двумерного массива
   * 
   * @param type $arrayParam
   * @param type $elementTable
   */
  protected function getTableBlocs($arrayParam, $elementTable = 'tr')
  {
    $table = '';
    foreach ($arrayParam as $key => $param)
    {
      $table .= '<'.$elementTable.'>';
      if (is_array($param))
      {
        $table .= $this->getTableBlocs($param, 'td');
      }
      elseif (is_string($key))
      {
        $table .=  $param ;
      }
      $table .= '</'.$elementTable.'>';
    }
    return $table;
  }
  
  public function createTable($tableBlocs)
  {
    return '<table '.$this->attr.'>'.  $this->getTableBlocs($tableBlocs).'</table>';
  }
 
}

