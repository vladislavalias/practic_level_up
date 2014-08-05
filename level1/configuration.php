<?php

class configuration
{
  CONST DEFAULT_CONFIG = 'home'; 
  
  protected static $configuration = [
    'machines' => [
       'vlad' => 'Opera/9.80 (X11; Linux x86_64; U; ru) Presto/2.10.289 Version/12.02', 
       'home' => '', 
    ],  
    'mysql' => [
        'vlad' => array(
            'host' => 'localhost',
            'dbname' => 'test_level1_oop',
            'user' => 'root',
            'password' => 'psofroot',
        ),
        'home' => array(
            'host' => 'localhost',
            'dbname' => 'test_classes',
            'user' => false,
            'password' => false,
        )
    ]  
  ];
  
  /**
   * Получаем массив необходимых настроек (конфигураций) 
   * 
   * @param string $name
   * @param mixed $default
   * @return array
   */
  static public function get($name, $default = FALSE)
  {
    return isset(self::$configuration[$name]) ? self::$configuration[$name] : $default;
  }
}

