<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailParserUpgrade
 *
 * @author valias
 */ 
class emailParserUpgrade 
{  
  
    private  $condTemplate = array(
                      'lenght',
                      'firstSymbol',
                      'domain', 
                      'startDate', 
                      'startTime', 
                      'finishDate', 
                      'finishTime', 
                    );
  
/**
 * Выводим массив эл. адресов, которые удовлетворяют условиям
 * 
 * @param array $multyArray Распарсенный массив
 * @param array $condition Массив условий
 * @param int $numberEntry Номер вхождения в $multyArray
 */
public function getValueFromMultyArray($multyArray, $condition, $numberEntry = 0)
  {
    global $result;
    $typeCondition     = $this->condTemplate[$numberEntry];

    foreach ($multyArray as $key => $value)
    {
      $operator = $this->getAction($typeCondition);
      if ($this->checkCondition($key, $condition, $typeCondition, $operator))
      {
        if (is_string($value))
        {
          $result[] = $value;
        }
        else
        {
          $this->getValueFromMultyArray(
                                    $value, 
                                    $condition, 
                                    $numberEntry + 1);
        }
      }      
    }

    return $result;
  }
  
  /**
   * Парсим электронные адреса по необходимым параметрам
   * 
   * @param string $fileName
   * @return array
   */
  public function getParsedEmail($fileName)
  {
    $parseEmails = array();
    $arrayEmails = $this->getArrayEmails($fileName);
    foreach ($arrayEmails as $email)
    {
      if ($email)
      {
        $emailParam = $this->getParamEmail($email);
        $parseEmails[$emailParam['lenght']]
                    [$emailParam['firstSymbol']]
                    [$emailParam['domain']]
                    [$emailParam['startDate']]
                    [$emailParam['startTime']]
                    [$emailParam['finishDate']]
                    [$emailParam['finishTime']] = $email;
      }
    }
    
    return $parseEmails;
  }
  
  /**
   * Определяем оператор сравнения данных с условием
   * @param string $typeCondition
   * @return string
   */
  private function getAction($typeCondition)
  {
      $operator = '';
      if (in_array($typeCondition, array('lenght', 'firstSymbol', 'domain')))
      {
        $operator = '=';
      }
      elseif (in_array($typeCondition, array('startDate', 'startTime')))
      {
        $operator = '>';
      }
      elseif (in_array($typeCondition, array('finishDate', 'finishTime')))
      {
        $operator = '<';
      }
      
      return $operator;
  }
  
  /**
   * Проверка на соответствие условию
   * @param mixed $data      Входные данные
   * @param mixed $condition Условие на соответствие
   * @param string $operator Оператор сравнения
   * @return boolean
   */
  private function checkCondition($data, $condition, $typeCondition, $operator)
  {
    if (!isset($condition[$typeCondition]) 
        || !$condition[$typeCondition]) return TRUE;
    if ($operator == '=')
    {
      if ($condition[$typeCondition] == $data) return true;
    }
    if ($operator == '>')
    {
      if ($condition[$typeCondition] > $data) return true;
    }
    if ($operator == '<')
    {
      if ($condition[$typeCondition] < $data) return true;
    }
  }
  
  /**
   * Получаем массив электронных адресов
   * 
   * @param string $fileName
   * @return array
   */
  private function getArrayEmails($fileName)
  {
    
    return explode(PHP_EOL, $this->readFile($fileName));
  }
  
  /**
   * Получаем параметры электронного адреса в виде массива с такими ключами:
   * Длина имени эл. адреса 
     Первый символ 
     почтовый домен 
     Начальная дата
     Начальное время
     Конечная дата
     Конечное время
   * 
   * @param string $emailData
   */
  private function getParamEmail($emailData)
  {
    $emailParam = array();
    //пример строки 
    //t37sv7ios@google.com "2011-04-17 11:34:16" "2013-12-13 23:27:19"
    $emailData = str_replace('"', '', $emailData);
    $emailElements = explode(' ', trim($emailData));
    // в результате получаем массив из 3 значений, где 
    // $emailElements[0] - электронный адрес, 
    // $emailElements[1] - начальная дата,
    // $emailElements[2] - начальное время
    // $emailElements[3] - конечная дата 
    // $emailElements[4] - конечное время
    $emailParam['firstSymbol'] = mb_substr($emailElements[0], 0, 1);
    $emailNameAndDomain = explode('@', trim($emailElements[0]));
    // $emailNameAndDomen - массив с именем эл. адреса под ключем 0  
    // и доменом под ключем 1
    $emailParam['lenght'] = strlen($emailNameAndDomain[0]);
    $emailParam['domain'] = $emailNameAndDomain[1];
    $emailParam['startDate'] = $emailElements[1];
    $emailParam['startTime'] = $emailElements[2];
    $emailParam['finishDate'] = $emailElements[3];
    $emailParam['finishTime'] = $emailElements[4];
     
    return $emailParam;
  }


  
  /**
   * Read file content from inputed path and name.
   * @param string $fileName
   * @return string
   */
  protected function readFile($fileName)
  {
    $result = '';
    
    if ($this->isValidFile($fileName))
    {
      $result = file_get_contents($fileName);
    }
    
    return $result;
  }

  /**
   * Check is file valid resource.
   * @param string $file
   * @return bool
   */
  protected function isValidFile($file)
  {
    return file_exists($file) && is_readable($file);
  }
}
