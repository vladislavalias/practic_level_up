<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of parser
 *
 * @author valias
 */
class parser
{
  private $template = array(
      'lenght'      => array(),
      'domain'      => array(),
      'firstSymbol' => array(),
      'startDate'   => array(),
      'startTime'   => array(),
      'finishDate'  => array(),
      'finishTime'  => array(),
  );

/**
 * Создает массив в формате ключ1 - ключ2 - значение, 
 * где ключ1 - тип фильтра (длина, домен, начальная дата и т.д.),
 * ключ2 - фильтр поиска, 
 * а значение - количество элементов, которые удовлетворяют условию
 * @param string file
 * @return array
 */
  public function statistic($file)
  {
    $statistic = array();
    
    $handle = fopen($file, 'r');

    while (!feof($handle))
    {
      $content = str_replace('"', '', trim(fgets($handle, 128)));
      $content = str_replace('@', ' ', $content);
      $n = sscanf($content, '%s %s %s %s %s %s', $name, $domain, $startDate, $startTime, $finishDate, $finishTime); 

      $firstSymbol = $name[0];
      $length = strlen($name);
      $this->counter('lenght', $length);
      $this->counter('domain', $domain);
      $this->counter('firstSymbol', $firstSymbol);
      $this->counter('startDate', $startDate);
      $this->counter('startTime', $startTime);
      $this->counter('finishDate', $finishDate);
      $this->counter('finishTime', $finishTime);
    }
    fclose($handle);
    
    return $this->template;
  }
  
  private function counter($key1, $key2)
  {
    $statistic = &$this->template;
    if (!isset($statistic[$key1][$key2]))
    {
      $statistic[$key1][$key2] = 1;
    }
    else
    {
      $statistic[$key1][$key2] += 1;
    }
  }
  
}
