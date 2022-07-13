<?php

namespace Managers;

use PDO;


abstract class BddManager
{
   protected $dbase = null;

   public function __construct()
   {
       if($this->dbase === null)
       {
            $this->connexion();
       }
      
    }

    private function connexion()
    {
        try
        {
            $this->dbase = new PDO('mysql:host=' . getenv('DATABASE_HOST') . ';dbname=' . getenv('DATABASE_NAME'), getenv('DATABASE_USER'), getenv('DATABASE_PASSWORD'), array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
            $this->dbase->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } 
        catch (PDOException $e) 
        {
            echo 'Connexion échouée : ' . $e->getMessage();
        }
    }

}
