<?php

class templates
{
    public static $arrayFormElements = array(
        array(
            'html_element' => 'input',
            'name' => 'auth[login]',
            'type' => 'text',
        ),
        array(
            'html_element' => 'input',
            'name' => 'auth[password]',
            'type' => 'password'
        ),
        array(
            'html_element' => 'input',
            'name' => 'auth[submit]',
            'type' => 'submit'
        ),
    );
    
    public static $arrayFormElementsExit = array(
        array(
            'html_element' => 'input',
            'name' => 'Exit',
            'type' => 'submit'
        ),
    );
    
    public static $arrayFormElementsClick = array(
        array(
            'html_element' => 'input',
            'name' => 'Click',
            'type' => 'submit'
        ),
    );
}

