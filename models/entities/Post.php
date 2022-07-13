<?php

namespace Entities;

class Post extends Entity
{
    private $id;
    private $title;
    private $chapo;
    private $content; 
    private $dateCreation;
    private $dateUpdate;
    private $user_id;
    private $user;
  


    /**
     * -- Getters --
     */

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function chapo()
    {
        return $this->chapo;
    }
    
    public function content()
    {
        return $this->content;
    }

    public function dateCreation()
    {
        return $this->dateCreation;
    }

    public function dateUpdate()
    {
        return $this->dateUpdate;
    }

    public function user_id()
    {
        return $this->user_id;
    }
    public function user()
    {
        return $this->user;
    }

    /**
     * -- Setters --
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setChapo($chapo)
    {
        $this->chapo = $chapo;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }

    public function setDateUpdate($dateUpdate)
    {
        $this->dateUpdate = $dateUpdate;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;
    }
    
    public function setUser(User $user)
    {
        $this->user = $user;
    }
}