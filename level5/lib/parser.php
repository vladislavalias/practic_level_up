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
 * @param type $arrayEmails
 * @return int
 */
  public function statistic($arrayEmails)
  {
    $statistic = $this->template;
    
    foreach ($arrayEmails as $email)
    {
      $email = str_replace('"', '', $email);
      $emailElements = explode(' ', trim($email));
      $nameDomainEmail = explode('@', $emailElements[0]);
      
      $lenght      = strlen($nameDomainEmail[0]);
      $domain      = $nameDomainEmail[1];
      $firstSymbol = $email[0];
      $startDate   = $emailElements[1];
      $startTime   = $emailElements[2];
      $finishDate  = $emailElements[3];
      $finishTime  = $emailElements[4];
      
      foreach ($statistic as $key => $value)
      {
        if (!isset($statistic[$key][$$key]))
        {
          $statistic[$key][$$key] = 1;
        }
        else
        {
          $statistic[$key][$$key] += 1;
        }
      }
    }
    
    return $statistic;
  }
}
