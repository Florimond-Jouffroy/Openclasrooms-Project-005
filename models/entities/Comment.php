<?php

namespace Entities;

class Comment extends Entity
{
    private $id;
    private $content;
    private $disabled;
    private $date_creation;
    private $user_id;
    private $post_id;
    private $user;
    private $post;

   
    //Getters

    public function id()
    {
        return $this->id;
    }

    public function content()
    {
        return $this->content;
    }

    public function disabled()
    {
        return $this->disabled;
    }

    public function date_creation()
    {
        return $this->date_creation;
    }

    public function user_id()
    {
        return $this->user_id;
    }

    public function post_id()
    {
        return $this->post_id;
    }

    public function user()
    {
        return $this->user;
    }

    public function post()
    {
        return $this->post;
    }

    //Setters

    public function setId($id) 
    {
    	$this->id = $id;
    }

    public function setContent($content) 
    {
    	$this->content = $content;
    }

    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    public function setDate_creation($date_creation) 
    {
    	$this->date_creation = $date_creation;
    }

    public function setUser_id($user_id){
        $this->user_id = $user_id;
    }

    public function setPost_id($post_id) 
    {
    	$this->post_id = $post_id;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function setPost(Post $post)
    {
        $this->post = $post;
    }
}