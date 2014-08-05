<?php

class mysql
{
  protected $db;
  
  public function __construct()
  {
    $this->setConnection(new PDO('mysql:host=localhost;dbname=test_classes'));
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

