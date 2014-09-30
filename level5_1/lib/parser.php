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
      'lenght'      => null,
      'domain'      => null,
      'firstSymbol' => null,
      'startDate'   => null,
      'startTime'   => null,
      'finishDate'  => null,
      'finishTime'  => null,
      'allNumber'   => 0
  );

/**
 * Подсчет статистики по элементам
 * @param type $postData
 * @param type $file
 * @return int
 */
  public function statistic($postData, $file)
  {
    $statistic = $this->template; // берем шаблон

    if (!$postData)      return $statistic; // если условия нет, сразу возвращаем результат
    $postData  = array_diff($postData, array('', NULL, false)); // чистим данные ПОСТа от пустых элементов
    if (!$postData)      return $statistic; // если в условии ничего не осталось, возвращаем результат
    $handle = fopen($file, 'r');

    while (!feof($handle))
    {
      $content = str_replace('"', '', trim(fgets($handle, 128)));
      $content = str_replace('@', ' ', $content);
      if (!$content)        continue; // если строка пустая, пропускаем ее
      $n = sscanf($content, '%s %s %s %s %s %s', $name, $domain, $startDate, $startTime, $finishDate, $finishTime); 

      $firstSymbol = $name[0];
      $lenght = strlen($name);
      
      $statistic['lenght'] += $this->isCondNotEmpty($lenght, $postData, 'lenght', '=');
      $statistic['domain'] += $this->isCondNotEmpty($domain, $postData, 'domain', '=');
      $statistic['firstSymbol'] += $this->isCondNotEmpty($firstSymbol, $postData,'firstSymbol', '=');
      $statistic['startDate'] += $this->isCondNotEmpty($startDate, $postData, 'startDate', '<');
      $statistic['startTime'] += $this->isCondNotEmpty($startTime, $postData, 'startTime', '<');
      $statistic['finishDate'] += $this->isCondNotEmpty($finishDate, $postData, 'finishDate', '>');
      $statistic['finishTime'] += $this->isCondNotEmpty($finishTime, $postData, 'finishTime', '>');
      $statistic['allNumber'] += 1;
    }
    fclose($handle);
    
    return $statistic;
  }
  
  /**
   * Сравниваем значения 
   * @param mixed $data
   * @param mixed $condition
   * @param string $operator
   * @return int
   */
  private function compare($data, $condition, $operator)
  {
    if ($operator == '=')
    {
      if ($data == $condition) return 1;
    }
    if ($operator == '>')
    {
      if ($data > $condition) return 1;
    }
    if ($operator == '<')
    {
      if ($data < $condition) return 1;
    }
    
    return null;
  }
  
  /**
   * Проверяем наличие условия 
   * @param type $data
   * @param type $condition
   * @param type $operator
   * @return int
   */
  private function isCondNotEmpty($data, $conditionArray, $conditionKey, $operator)
  {
    if (isset($conditionArray[$conditionKey])) 
    {
      return $this->compare($data, $conditionArray[$conditionKey], $operator);
    }
    else
    {
      return null;
    }
  }
}
