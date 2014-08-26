<?php

class emailParser
{
  /**
   * Return parsed data from file by fileName.
   * @param string $fileName
   * @return array
   */
  public function getDataFrom($fileName)
  {
    return $this->parseData(
      $this->readFile($fileName)
    );
  }

  /**
   * Parse readed content from file.
   * @param string $content
   * @return array
   */
  protected function parseData($content)
  {
    $result       = array();
    $splitLines   = explode("\n", $content);
    
    foreach ($splitLines as $line)
    {
      $arrayElement = explode(' ', $line);
      $this->arrayParsedData[$this->getdate($arrayElement[1])][$this->getdate($arrayElement[2])][] = array($arrayElement[0], $arrayElement[1], $arrayElement[2]);
    }
    
    return $this->arrayParsedData;
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

  private function getDate($dateTime)
  {
    $date = explode(' ', $dateTime);
    
    return $date[0];
  }
}

