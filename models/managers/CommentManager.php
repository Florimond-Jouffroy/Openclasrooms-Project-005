<?php

namespace Managers;

use Entities\Comment;
use Entities\User;
use Entities\Post;
use PDO;

class CommentManager extends BddManager
{   
    
    public function getComments()
    {
        $req = $this->dbase->prepare('SELECT c.id, c.content, c.disabled, c.date_creation, c.post_id, c.user_id, u.firstname, u.lastname, u.email, u.user_type, p.title, p.chapo  
        FROM comment c INNER JOIN user u  ON c.user_id = u.id INNER JOIN post p ON c.post_id = p.id');
        $req->execute();

        $comments = [];
        while( ($row = $req->fetch(PDO::FETCH_ASSOC)) !== false)
        {
           
            $user = new User([
                'id'=>$row['user_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'email'=>$row['email'],
                'user_type'=>$row['user_type']
            ]);

            $post = new Post([
                'id'=>$row['post_id'],
                'title'=>$row['title'],
                'chapo'=>$row['chapo'],
            ]);

            $comment = new Comment([
                'id'=>$row['id'],
                'content'=>$row['content'],
                'disabled'=>$row['disabled'],
                'date_creation'=>$row['date_creation'],
                'post_id'=>$row['post_id'],
                'user'=>$user,
                'post'=>$post
            ]);

            $comments[] = $comment;
        }
        
        return $comments;
    }
    

    // Création d'un commentaire
    public function create(Comment $comment) : void
    {
        $req = $this->dbase->prepare('INSERT INTO comment (content, disabled, date_creation, user_id, post_id) VALUES (?, ?, NOW(), ?, ? )');
        $req->execute([$comment->content(), $comment->disabled(), $comment->user_id(), $comment->post_id()]);
    }

    
    // Retourne tous les commentaires lié au post_id
  
    public function getCommentsByPost($post_id)
    {
        $req = $this->dbase->prepare('SELECT c.id, c.content, c.disabled, c.date_creation, c.post_id, c.user_id, u.firstname, u.lastname, u.email, u.user_type FROM comment c INNER JOIN user u ON c.user_id = u.id WHERE c.post_id = ?');
        $req->execute([$post_id]);

        $comments = [];
        while( ($row = $req->fetch(PDO::FETCH_ASSOC)) !== false)
        {
            $user = new User([
                'id'=>$row['user_id'],
                'firstname'=>$row['firstname'],
                'lastname'=>$row['lastname'],
                'email'=>$row['email'],
                'user_type'=>$row['user_type']
            ]);
            $comment = new Comment([
                'id'=>$row['id'],
                'content'=>$row['content'],
                'disabled'=>$row['disabled'],
                'date_creation'=>$row['date_creation'],
                'post_id'=>$row['post_id'],
                'user'=>$user,
            ]);
            $comments[] = $comment;
        }
        
        return $comments;
    }

    // Retourne le commentaire lié a l'id
    public function getCommentById($id)
    {
        $req = $this->dbase->prepare('SELECT * FROM comment WHERE id = ?');
        $req->execute([$id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entities\Comment');
        
        return $req->fetch();
    }

    // Suppression de tous les commentaires lié au post_id
    public function deleteByPostId($post_id) : void
    {
        $req = $this->dbase->prepare('DELETE FROM comment WHERE comment.post_id = ?');
        $req->execute([$post_id]);
    }

    // Suppression de tous les commentaires lié au user_id
    public function deleteByUserId($user_id) : void
    {
        $req = $this->dbase->prepare('DELETE FROM comment WHERE comment.user_id = ?');
        $req->execute([$user_id]);
    }

    // Suppression du commentaire lié a l'id
    public function delete($id) : void
    {
        $req = $this->dbase->prepare('DELETE FROM comment WHERE comment.id = ?');
        $req->execute([$id]);
    }

    // Update du commentaire
    public function update(Comment $comment) : void
    {
        $req = $this->dbase->prepare('UPDATE comment SET content = ?, disabled = ?, date_creation = ?, user_id = ?, post_id = ? WHERE id = ?');
        $req->execute([$comment->content(), $comment->disabled(), $comment->date_creation(), $comment->user_id(), $comment->post_id(), $comment->id()]);
    }

}