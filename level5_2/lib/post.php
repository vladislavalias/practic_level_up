<?php

class post
{
  /**
   * 
   * @return type
   */
  public function get()
  {
    $postData = filter_input_array(INPUT_POST);
    
    return $postData;
  }
}

