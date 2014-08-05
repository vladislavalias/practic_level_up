<?php

class loadMysqlConfig
{
  CONST DEFAULT_MACHINES_KEY = 'machines';
  
  /**
   * Загружаем конфигурации в зависимости от того, на каком устройстве
   * запускается приложение
   * 
   * @return array
   */
  public function load()
  {
    $configName = $this->checkUserAgent();
    $mysqlConfig = configuration::get('mysql');
    
    return $mysqlConfig[$configName];
  }

  /**
   * Определяем, на каком устройстве запускается приложение
   * 
   * @return string
   */
  protected function checkUserAgent()
  {
    $machines = $this->getMachinesConfig();
    $currentUserAgent = $this->getHeader('User-Agent', '');
    foreach ($machines as $name => $userAgent)
    {
      if ($userAgent == $currentUserAgent)
      {
        
        return $name;
      }
    }
    
    return configuration::DEFAULT_CONFIG;
  }

  /**
   * Извлекаем необходимые значения из header`a
   * @param string $name
   * @param mixed $default
   * @return string
   */
  protected function getHeader($name, $default = false)
  {
    $headers = getallheaders();
    
    return isset($headers[$name]) ? $headers[$name] : $default;
  }
  
  /**
   * Получаем массив настроек (конфигураций) для всех пользователей
   * @return array
   */
  protected function getMachinesConfig()
  {
    return configuration::get(self::DEFAULT_MACHINES_KEY, array());
  }
}

