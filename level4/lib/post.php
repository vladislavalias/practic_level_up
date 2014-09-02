<?php

class post
{
    /**
     * Извлечение данных из поста (одно- двумерный массив)
     * 
     * @param string $firstKey
     * @param string $secondKey
     * @return mixed
     */
    static function get($firstKey, $secondKey = FALSE, $default = '')
    {
        $post = filter_input_array(INPUT_POST);
        if (!$post)
        {
            return $default;
        }
        if ($secondKey)
        {
            return $post[$firstKey][$secondKey];
        }
        else
        {
            return $post[$firstKey];
        }
    }
    
    /**
     * Сохраняет данные из поста в сессию и выводит результат
     * @param string $key1
     * @param string $key2
     */
    static function saveToSessionAndShow($key1, $key2)
    {
      $post = post::get($key1, $key2, NULL);
      if ($post !== NULL)
      {
        $_SESSION[$key1][$key2] = $post;
        return $_SESSION[$key1][$key2];
      }
      
      if (isset($_SESSION[$key1][$key2]))
      {
        return $_SESSION[$key1][$key2];
      }
      
      return '';
    }
}

