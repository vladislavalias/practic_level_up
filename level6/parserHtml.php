<?php

class parserHtml
{
  
  private $queryString = array(
      'yandex'   => 'http://yandex.ua/yandsearch?text=%s&lr=960&p=%d',
      'sputnik'  => 'http://www.sputnik.ru/search?q=%s&from=%d1',
      'mail'     => 'http://go.mail.ru/search?q=%s&rch=l&sf=%d0',
      'rambler'  => 'http://nova.rambler.ru/search?query=%s&page=%d',
      'google'   => 'https://www.google.com.ua/search?q=%s&hl=ru-UA&gbv=2&prmd=ivnsa&                    ei=LxIpVOLJB4fpywPVew&start=%d0&sa=N&filter=0',
      'default'  => 'https://www.google.com.ua/search?q=%s&hl=ru-UA&gbv=2&prmd=ivnsa&                    ei=LxIpVOLJB4fpywPVew&start=%d0&sa=N&filter=0'
  );
  
  private $searchElement = array(
      'yandex'   => '.serp-url__item',
      'sputnik'  => '.b-s-r-link',
      'mail'     => '',
      'rambler'  => '',
      'google'   => 'cite',
      'default'  => 'cite'
  );


  /**
   * Извлекаем из контента массив искомых значений (названия сайтов)
   * 
   * @param where $where Выбор поисковой системы
   * @param string $query Строка запроса
   * @param integer $depthSearch Количество страниц для парсинга 
   * @return array
   */
  public function getArrayCites($where, $query, $depthSearch)
  {
    $result = array();
    $html = $this->multi_request($where, urlencode($query), $depthSearch);
    for ($i = 0; $i < count($html); $i++)
    {
      $dom = str_get_html($html[$i]);
      $arrayDOMElements = $dom->find($this->searchElement[$where]);
      foreach ($arrayDOMElements as $object)
      {
        $result[$i][] = $object->innertext();
      }
    }
    
    return $result;
  }
  
  /**
   * Создаем массив ссылок, которые необходимо распарсить
   * @param where $where Выбор поисковой системы
   * @param string $query Строка запроса
   * @param integer $depthSearch Количество результатов для парсинга ( *10)
   * @return array 
   */
  private function getUrls($where, $query, $depthSearch)
  {
    $arrayTemplateStrings = $this->queryString;
    $templateString = array_key_exists($where, $arrayTemplateStrings) 
                      ? $arrayTemplateStrings[$where] 
                      : $arrayTemplateStrings['default'];
    $urls = array();
    for ($i = 0; $i < $depthSearch; $i++)
    {
      $urls[] = sprintf($templateString, $query, $i);
    }
    
    return $urls;
  }
  
  /**
   * Получаем контент со всех страниц
   * @param where $where Выбор поисковой системы
   * @param string $query Строка запроса
   * @param integer $depthSearch Количество результатов для парсинга ( *10)
   * @return string
   */
  private function multi_request($where, $query, $depthSearch) 
  {
    $urls = $this->getUrls($where, $query, $depthSearch);
    $curly = array();

    $result = array();

    $mh = curl_multi_init();

    foreach ($urls as $id => $url) {

      $curly[$id] = curl_init();

      curl_setopt($curly[$id], CURLOPT_URL, $url);

      curl_setopt($curly[$id], CURLOPT_HEADER, 0);

      curl_setopt($curly[$id], CURLOPT_RETURNTRANSFER, 1);

      curl_setopt($curly[$id], CURLOPT_TIMEOUT, 30);

      curl_setopt($curly[$id], CURLOPT_FOLLOWLOCATION, true);

      curl_setopt($curly[$id], CURLOPT_SSL_VERIFYPEER, 0);

      curl_setopt($curly[$id], CURLOPT_SSL_VERIFYHOST, 0);

      curl_setopt($curly[$id], CURLOPT_USERAGENT,"Mozilla/5.0(Windows;U;WindowsNT5.1;ru;rv:1.9.0.4)Gecko/2008102920AdCentriaIM/1.7Firefox/3.0.4");

      //curl_setopt($curly[$id], CURLOPT_COOKIEJAR,'cookies.txt');

      //curl_setopt($curly[$id], CURLOPT_COOKIEFILE,'cookies.txt');

      curl_multi_add_handle($mh, $curly[$id]);

    }

    $running = null;

    do {

      curl_multi_exec($mh, $running);

    } while($running > 0);

    foreach($curly as $id => $c) {

      $result[$id] = curl_multi_getcontent($c);

      curl_multi_remove_handle($mh, $c);

    }

    curl_multi_close($mh);

    return $result;
  }

}

