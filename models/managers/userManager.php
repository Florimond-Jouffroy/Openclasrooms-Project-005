<?php

namespace Managers;

use Entities\User;
use PDO;

class UserManager extends BddManager
{
    //Création d'un utilisateur
    public function create(User $user) : void
    {
        //Permet la création quand nous avons la variable user_type
        if($user->user_type() != NULL)
        {
            $req = $this->dbase->prepare('INSERT INTO user (firstname, lastname, email, password, user_type, date_creation) VALUES (?, ?, ?, ?, ?, NOW())');
            $req->execute([$user->firstname(), $user->lastname(), $user->email(), $user->password(), $user->user_type()]);
        }
        else
        {
            $req = $this->dbase->prepare('INSERT INTO user (firstname, lastname, email, password, date_creation) VALUES (?, ?, ?, ?, NOW())');
            $req->execute([$user->firstname(), $user->lastname(), $user->email(), $user->password()]);
        }

    }

    //Update d'un utilisateur 
    public function update(User $user) : void
    {
        $req = $this->dbase->prepare('UPDATE user SET firstname = ?, lastname = ?, email = ?, user_type = ? WHERE id = ?');
        $req->execute([$user->firstname(), $user->lastname(), $user->email(), $user->user_type(), $user->id()]);
    }

    //Suppression d'un utilisateur
    public function delete($id)
    {
        $req = $this->dbase->prepare('DELETE FROM user WHERE user.id = ?');
        $req->execute([$id]);
    }
   
    //Recherche d'un utilisateur par son adress mail
    public function getUserByLogin($login)
    {
        $req = $this->dbase->prepare('SELECT * FROM user WHERE user.email = ?');
        $req->execute([$login]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
        return $req->fetch();    
    }

    //Recherche d'un utilisateur par son id
    public function getUserById($id)
    {
        $req = $this->dbase->prepare('SELECT * FROM user WHERE user.id = ?');
        $req->execute([$id]);
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
        return $req->fetch();    
    }

    //Recherche tous les utilisateurs 
    public function getUsers()
    {
        $req = $this->dbase->prepare('SELECT * FROM user');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
        return $req->fetchAll();

    }

    public function getAdmins()
    {
        $req = $this->dbase->prepare('SELECT * FROM user WHERE user_type = 1');
        $req->execute();
        $req->setFetchMode(PDO::FETCH_CLASS, 'Entities\User');
        return $req->fetchAll();
    }

}