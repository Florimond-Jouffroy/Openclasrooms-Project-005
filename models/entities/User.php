<?php

namespace Entities;

class User extends Entity
{
    
    private $id;
    private $firstname;
    private $lastname;
    private $email;
    private $password;
    private $user_type;
    private $dateCreation;
    



    public function hashPassword()
    {
        $this->password = password_hash($this->password , PASSWORD_BCRYPT);
    }


    //------Getters------

    public function id()
    {
        return $this->id;
    }

    public function firstname()
    {
        return $this->firstname;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function email()
    {
        return $this->email;
    }

    public function password()
    {
        return $this->password;
    }

    public function user_type()
    {
        return $this->user_type;
    }

    public function dateCreation()
    {
        return $this->dateCreation;
    }
    

    //------Setters------

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setUser_type($userType)
    {
        $this->user_type = $userType;
    } 

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

}