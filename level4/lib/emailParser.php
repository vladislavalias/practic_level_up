<?php

class emailParser
{
    /**
     * Массив данных для отображения
     * @param string $fileName
     * @param string $startSelector
     * @param string $finishSelector
     * @return array
     */
    public function toShow($fileName, $startSelector, $finishSelector)
    {
        $startSelector  = !$startSelector ? '2015-01-01' : $startSelector;
        $finishSelector = !$finishSelector ?  '1990-01-01' : $finishSelector;
        $result = array();
        $data = $this->getDataFrom($fileName);
        foreach ($data as $startDate => $arrayByFinishDate)
        {
            if ($startSelector > $startDate)
            {
                foreach ($arrayByFinishDate as $finishDate => $value)
                {
                    if ($finishDate > $finishSelector)
                    {
                        $result[] = $value;
                    }
                }
            }
        }
        return $result;
    }
    
    /**
   * Return parsed data from file by fileName.
   * @param string $fileName
   * @return array
   */
  private function getDataFrom($fileName)
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
    $splitLines          = explode($this->chooseDelimeter(), $content);
    $splitLinesCleared   = array_diff($splitLines, array('', ' ', NULL, FALSE));
    
    foreach ($splitLinesCleared as $line)
    {
      $arrayElement = explode('"', $line);
      $arrayElementCleared = array_diff($arrayElement, array('', ' ', NULL, FALSE));
//      var_dump($arrayElement);      exit();
//      счастливой отладки, суки
      $this->arrayParsedData[$this->getdate($arrayElementCleared[1])][$this->getdate($arrayElementCleared[3])][] = array($arrayElementCleared[0], $arrayElementCleared[1], $arrayElementCleared[3]);
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
  
  private function chooseDelimeter()
  {
      if (strpos(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'), 'Windows'))
      {
          return "\r\n";
      }
      elseif (strpos(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'), 'Linux'))
      {
          return "\n";
      }
      else
      {
          return "\r";
      }
  }
}

