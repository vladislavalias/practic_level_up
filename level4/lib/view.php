<?php

class view
{
    public function show($arrayDataEmails)
    {
        $view = '<table border="1">';
        foreach ($arrayDataEmails as $arrayDataEmail)
        {
            $view .= '<tr>';
            foreach ($arrayDataEmail as $dataEmail)
            {
                foreach ($dataEmail as $element)
                {
                    $view .= '<td>'.$element.'</td>';
                }
            }
            $view .= '</tr>';
        }
        $view .= '</table>';
        return $view;
    }
}

