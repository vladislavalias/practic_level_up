<?php

class filter
{
  public function getNumberCites($arrayCites, $domain)
  {
    $result = array();
    
    for ($i = 0; $i < count($arrayCites); $i++)
    {
      for ($j = 0; $j < count($arrayCites[$i]); $j++)
      {
        var_dump(strpos($arrayCites[$i][$j], $domain));
        var_dump($arrayCites[$i][$j]);
        var_dump($domain);        exit();
        if (strpos($arrayCites[$i][$j], $domain))
        {
          $result[] = $i * 10 + $j + 1;
        }
      }
    }
    
    return $result;
  }
}

