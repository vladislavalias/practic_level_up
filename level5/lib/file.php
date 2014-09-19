<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file
 *
 * @author valias
 */
class file
{
  /**
   * Получаем массив электронных адресов
   * 
   * @param string $fileName
   * @return array
   */
  public function getArrayEmails($fileName)
  {
    
    $array = explode(PHP_EOL, $this->readFile($fileName));
    return array_diff($array, array(NULL, '', FALSE));
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
