<?php

class html
{
  protected $attr = 'border="1"';
  const openTag = '<';
  const openCloseTag = '</';
  const closeTag = '>';
  const table = 'table';
  /**
   * Формирование блоков таблицы на основании двумерного массива
   * 
   * @param type $arrayParam
   * @param type $elementTable
   */
  protected function getTableBlocs($arrayParam, $elementTable = 'tr')
  {
    $table = '';
    foreach ($arrayParam as $key => $param)
    {
      $table .= self::openTag.$elementTable.self::closeTag;
      if (is_array($param))
      {
        $table .= $this->getTableBlocs($param, 'td');
      }
      elseif (is_string($key))
      {
        $table .=  $param ;
      }
      $table .= self::openCloseTag.$elementTable.self::closeTag;
    }
    return $table;
  }
  
  public function createTable($tableBlocs)
  {
    return self::openTag.self::table.' '.$this->attr.self::closeTag.  
            $this->getTableBlocs($tableBlocs).self::openCloseTag.
            self::table.self::closeTag;
  }
}

