<?php

class construct
{
    /**
     * Собираем строку в  формате email "Начальная дата и время" "Конечная дата и время"
     * $numberString int Количество строк, которые необходимо получить
     * @return string
     */
    public function emailDateString($numberString = 1)
    {
        $result = '';
        for ($i=1; $i<= $numberString; $i++)
        {
            $email = $this->email();
            $startDate = $this->date();
            $finishDate = $this->date($startDate['date']);

            $result .= sprintf('%s "%s %s" "%s %s"', $email, $startDate['date'], 
            $startDate['time'], $finishDate['date'], $finishDate['time'])."\r\n";         
        }

        return $result;
    }
    
    /**
     * Генерим электронный адресс
     * @return string
     */
    private function email()
    {
        $availableSymbols = '123456789abcdefghijklnmopqrstuvwxyz';
        $availableEmail   = array('yandex.ua', 'google.com', 'i.ua');
        $name = '';
        $lenght = mt_rand(3, 15);
        for ($i = 0; $i < $lenght; $i++)
        {
          $name .= $this->random($availableSymbols);
        }
        $email = $this->random($availableEmail);
        $result = $name.'@'.$email;
        return $result;
    }
    
    /**
     * Получаем случайное значение из заданных параметров
     * $dataIn mixed
     * @return string Description
     */
    private function random($dataIn)
    {
        if(is_int($dataIn))
        {
            $rand = mt_rand(1, $dataIn);
            return $rand;
        }
        $numberElements = is_array($dataIn) ? count($dataIn) : strlen($dataIn);
        $rand = mt_rand(0, $numberElements - 1);
        $result = $dataIn[$rand];   
        
        return $result;
    }
    
    /**
     * Возвращаем количество дней в зависимости от месяца и года
     * 
     * @param int $month
     * @param int $year
     * @return int
     */
    private function daysInMonth($month, $year)
    {
        $days = 1;
        $months = array(
            '31daysInMonth' => array(1, 3, 5, 7, 8, 10, 12),
            '30daysInMonth' => array(4, 6, 9, 11),
            '28daysInMonth' => array(2)
        );
        
        foreach ($months as $dayInMonth => $arrayMonths)
        {
            if (in_array($month, $arrayMonths))
            {
                $days = (int)$dayInMonth;
            }
        }
        
        if ($days == 28 && $year % 4 == 0)
        {
            $days = 29;
        }
        return $days;
    }
    
    /**
     * Генерируем дату и время 
     * [проверяем на то, чтобы дата была больше предыдущей]
     * @param string $previousDate
     * @return array
     */
    private function date($previousDate = '1990-01-01', $templateYears = array('2010', '2011', '2012'))
    {
        $date = array();
        if (($previousDate) > '1990-01-01')   $templateYears   = array('2010', '2011', '2012', '2013');
        /**
         * Поскольку эта функция использует рекурсию, при выпадение первичной случайной даты -> max
         * вложенность функций стремится к бесконечности. При вложенности > 100 возникает fatal error.
         * Для избежания этой хрени, начальную дату генерим в диапазоне 2010-2012гг., а конечную дату -
         * в диапазоне 2010-2013гг.
         */
        $templateMonths = 12;
        
        $year = $this->random($templateYears);
        $month = $this->trailingZero($this->random($templateMonths));
        $day = $this->trailingZero($this->random($this->daysInMonth($month, $year)));
        $hour = $this->trailingZero($this->random(24) - 1);
        $minutes = $this->trailingZero($this->random(60) - 1);
        $seconds = $this->trailingZero($this->random(60) - 1);
        
        $date['date'] = sprintf('%d-%s-%s', $year, $month, $day);
        $date['time'] = sprintf('%s:%s:%s', $hour, $minutes, $seconds);
        
        if ($date['date'] > $previousDate)
        {
            return $date;
        }
        else
        {
            return $this->date($previousDate);
        }
    }
    
    /**
     * Добавляет ведущие нули
     * @param int $number
     * @return string
     */
    private function trailingZero($number, $numberDigits = 2)
    {
        $formatNumberDigits = '%0'.$numberDigits.'d';
        
        return sprintf($formatNumberDigits, $number);
    }
}

