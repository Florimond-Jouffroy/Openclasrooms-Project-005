<?php 

namespace App;

Class Request
{

    public function __call($name, $arguments)
    {
        if(substr($name, 0, 3) == 'get') {

            
            $value = $_GET[strtolower(substr($name, 3))];
            
            if(isset($value)) {
                return $value;
            } else {
                throw new \Exception("Il y a un souci avec la requête. Si le problème persiste contactez un administrateur.");
            }
        } else if(substr($name, 0, 4) == 'post') {
            $value = $_POST[strtolower(substr($name, 4))];
            if(isset($value))
            {
                return $value;
            }
            else 
            {
                throw new \Exception("Il y a un souci avec la requête. Si le problème persiste contactez un administrateur.");
            }
        }
        
    }

    public function all($type) {
        if($type == "POST") {
            return $_POST;
        } else if ($type == 'GET') {
            return $_GET;
        }
    }

    public function redirect($page)
    {
        header('location: '.$page);
    }
}