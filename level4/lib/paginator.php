<?php

class paginator
{
  static function pages($arrayData, $numberOnPage)
  {
    return ceil(count($arrayData) / $numberOnPage);
  }
  
  static function show($pages)
  {
    $view = '';
    for ($i = 1; $i <= $pages; $i++)
    {
      $view .= '<a href="index.php?page='.$i.'">'.$i.'</a>&nbsp';
    }
    return $view;
  }
}

