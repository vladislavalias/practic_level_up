<?php

class Singleton
{

  public $text; 
  private static $instance;  // экземпляра объекта

  private function __construct()
  { /* ... @return Singleton */
  }

// Защищаем от создания через new Singleton
  private function __clone()
  { /* ... @return Singleton */
  }

// Защищаем от создания через клонирование
  private function __wakeup()
  { /* ... @return Singleton */
  }

// Защищаем от создания через unserialize
  /**
   * 
   * @return Singleton type
   */
  public static function getInstance()
  {    // Возвращает единственный экземпляр класса. @return Singleton
    if (empty(self::$instance))
    {
      self::$instance = new self();
    }
    
    return self::$instance;
  }

  public function doAction()
  {
    echo $this->text;
    echo 'HAHA Im ALIVEEEEE!!!';
  }
}

abstract class grandParentClass
{
  abstract protected function getProtected();
  
  public function getPublic()
  {
    return $this->public;
  }
}

class parentTest extends grandParentClass
{
  public    $public     = 'PARENT:123';
  protected $protected  = 'PARENT:098';
  private   $private    = 'PARENT:123456890';
  
  public function getPrivate($name, $name2)
  {
    echo $name . $name2;
    
    return $this->private;
  }
  
  protected function getProtected()
  {
    return $this->protected;
  }
}

class test extends parentTest
{
  CONST CONST_ONE = 'sdfsdfsdf';
  
  static public $staticOne = array(
      'sdfsdf',
      ';lkjhgfds'
  );

  public    $public     = '123';
  protected $protected  = '098';
  private   $private    = '123456890';
  
  public function __construct()
  {
    $this->public = '123456789009876543211234567890';
  }
  
  public function __destruct()
  {
    echo 'I dont wonna diiiiiiiieeee....';
  }
  
  public function getPrivate($name, $name1232)
  {
    return $this->private . parent::getPrivate($name, $name1232) . $this->getProtected();
  }
  
  static public function staticOne()
  {
    return array('sdfsdf', 'sdfsdf');
  }
}

class Post
{
  protected $post;

  public function __construct()
  {
    $this->post = $_POST;
    
    unset($_POST);
  }
  
  public function get($name)
  {
    return $this->filterInput(
            isset($this->post[$name]) ?
            $this->post[$name] :
            false
      );
  }
  
  protected function filterInput($value)
  {
    return (integer)$value;
  }
}