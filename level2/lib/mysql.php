<?php

class mysql
{
  protected $db;
  
  private $defaultConfiguration = array(
    'host'      => false,
    'dbname'    => false,
    'user'      => false,
    'password'  => false
  );
  
  private $necessaryParameters = array(
      'host', 'dbname'
  );

  protected function isValidConfiguration($configuration)
  {
    $configuration = is_array($configuration) ? $configuration : array($configuration);
    
    $cleared      = array_diff($configuration, array('', false, null));
    $presentAll   = array_intersect_key(
      $configuration,
      $this->defaultConfiguration
    );
    
    $presentNecessary = array_intersect_key(
      $cleared,
      array_flip($this->necessaryParameters)
    );
    
    return sizeof($this->necessaryParameters) == sizeof($presentNecessary) &&
      sizeof($presentAll) == sizeof($this->defaultConfiguration); 
  }

  public function __construct($configuration)
  {
    if (!$this->isValidConfiguration($configuration)) return false;
    
    $pdo = sprintf(
      'mysql:host=%s;dbname=%s',
      $configuration['host'],
      $configuration['dbname']
    );
    
    $this->setConnection(
      new PDO(
        $pdo,
        $configuration['user'],
        $configuration['password']
      )
    );
  }
  
  /**
   * @return PDO
   */
  protected function getConnection()
  {
    return $this->db;
  }
  
  /**
   * 
   * @param PDO $connection
   * @return PDO
   */
  protected function setConnection($connection)
  {
    return $this->db = $connection;
  }

  /**
   * 
   * @param string $query
   * @param array $where
   * @return mixed
   */
  public function query($query, $where = array())
  {
    $result = FALSE;
    $stmt = $this->getConnection()->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    if($stmt->execute($where))
    {
      if (preg_match('/^SELECT/', $query))
      {
        $result = $stmt->fetchAll();
        return $result;
      }
      else
      {
        return true;
      }
    }
    return $result;
  }
}

