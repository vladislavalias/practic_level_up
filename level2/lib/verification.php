<?php

class verification 
{
    public function __construct($arrayPostData) {
        $login = $arrayPostData['login'];
        $password = $arrayPostData['password'];
    }
    
    public function isAuthenticated()
    {
    }
}

