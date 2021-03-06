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
    $statistic = $this->template;
    
    $handle = fopen($file, 'r');

    while (!feof($handle))
    {
      $content = str_replace('"', '', trim(fgets($handle, 128)));
      $content = str_replace('@', ' ', $content);
      $n = sscanf($content, '%s %s %s %s %s %s', $name, $domain, $startDate, $startTime, $finishDate, $finishTime); 

      $firstSymbol = $name[0];
      $lenght = strlen($name);
      
      $this->increment($statistic, 'lenght', $lenght);
      $this->increment($statistic, 'domain', $domain);
      $this->increment($statistic, 'firstSymbol', $firstSymbol);
      $this->increment($statistic, 'startDate', $startDate);
      $this->increment($statistic, 'startTime', $startTime);
      $this->increment($statistic, 'finishDate', $finishDate);
      $this->increment($statistic, 'finishTime', $finishTime);
    }
    fclose($handle);
    
    return $statistic;
  }
  
  private function increment($array, $key1, $key2)
  {
    if (!isset($array[$key1][$key2]))
    {
      $array[$key1][$key2] = 1;
    }
    else
    {
      $array[$key1][$key2] += 1;
    }
  }
  
}
