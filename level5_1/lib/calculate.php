<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of calculate
 *
 * @author valias
 */
class calculate
{
  
  public function getNumbers($where, $what, $operator = '=')
  {
    if (!$what) return '';
    if ($operator == '=')
    {
      return $this->numbersEqual($where, $what);
    }
    if ($operator == '>')
    {
      return $this->numbersBigger($where, $what);
    }
    if ($operator == '<')
    {
      return $this->numbersLess($where, $what);
    }
  }

  /**
   * Подсчет суммы значений по ключам, равным условию
   * @param array $where
   * @param string $what
   * @return int
   */
  private function numbersEqual($where, $what)
  {
    $result = 0;
    foreach ($where as $key => $value)
    {
      if ($what == $key)
      {
        $result += $value;
      }
    }
    
    return $result;
  }

  /**
   * Подсчет суммы значений по ключам, меньше условия
   * @param array $where
   * @param string $what
   * @return int
   */
  private function numbersBigger($where, $what)
  {
    $result = 0;
    foreach ($where as $key => $value)
    {
      if ($what > $key)
      {
        $result += $value;
      }
    }
    
    return $result;
  }

  /**
   * Подсчет суммы значений по ключам, больше условия
   * @param array $where
   * @param string $what
   * @return int
   */
  private function numbersLess($where, $what)
  {
    $result = 0;
    foreach ($where as $key => $value)
    {
      if ($what < $key)
      {
        $result += $value;
      }
    }
    
    return $result;
  }
}
