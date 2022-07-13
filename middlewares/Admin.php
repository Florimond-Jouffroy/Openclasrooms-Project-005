<?php

namespace Middlewares;

Class Admin 
{

    const ADMIN = 1;

    public function __construct()
    {
        return $this->isAdmin();
    }

    
    private function isAdmin()
    {
        return $_SESSION['user_type'] == self::ADMIN;
    }

}