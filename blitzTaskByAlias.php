<?php
//byVla
$start          = 1;
$end            = 10000;
$prefixTemplate = '%d element is ';
$suffix         = "\n<br />";
$multiplies     = [
  3 => 'Fizz',
  7 => 'Buzz',
  10 => 'FIZZBUZZMTHFCKR',
];

for ($i = $start; $i <= $end; $i++)
{
  $toWrite = '';
  
  foreach ($multiplies as $multiplyFor => $write)
  {
    if (0 == $i % $multiplyFor)
    {
      $toWrite .= $write;
    }
  }
  
  writeLn($toWrite ? : $i, sprintf($prefixTemplate, $i), $suffix);
}

function writeLn($line, $prefix = '', $suffix = '')
{
  echo sprintf('%s%s%s', $prefix, $line, $suffix);
}
// byVal
for ($i = 1; $i<101; $i++)
{
  $result = $i;
  if($i % 3 == 0)
  {
    $result = 'Fizz';
  }
  if ($i % 5 == 0) 
  {
    $result = is_int($result) ? 'Buzz' : 'FizzBuzz';
  }
  echo $result . '<br />';
}