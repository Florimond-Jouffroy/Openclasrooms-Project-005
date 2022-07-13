<?php

//Général
$router->get('', ['controller'=>'HomeController', 'action'=>'home']);
$router->get('home', ['controller'=>'HomeController', 'action'=>'home']);
$router->get('blog', ['controller'=>'PostController', 'action'=>'all']);
//Post
$router->get('post/:postId',['controller'=>'PostController','action'=>'show'])->withParam('postId', '[0-9]+');
//Post + comment
$router->post('addComment',['controller'=>'CommentController', 'action'=>'store']);

//Inscription
$router->get('inscription', ['controller'=>'UserController', 'action'=>'create']);
$router->post('inscription', ['controller'=>'UserController', 'action'=>'store']);

//Connexion et Déconnexion
$router->get('login', ['controller'=>'AuthController', 'action'=>'login']);
$router->post('login', ['controller'=>'AuthController', 'action'=>'connexion']);
$router->get('deconexion', ['controller'=>'AuthController', 'action'=>'deconnexion']);

//message
$router->post('message', ['controller'=>'HomeController', 'action'=>'message']);




//-----------------------------------------------------------------------------------
//Admin access

// gestion des posts
$router->get('gestionPosts', ['controller'=>'PostController', 'action'=>'allAdmin'])->withMiddleware('admin');
$router->get('gestionPosts/new', ['controller'=>'PostController', 'action'=>'create'])->withMiddleware('admin'); // Envoie sur la page du formulaire pour ajouter un article
$router->post('gestionPosts/new', ['controller'=>'PostController', 'action'=>'store'])->withMiddleware('admin'); // retour du formulaire d'ajout d'un article
$router->get('gestionPosts/delete/:postId', ['controller'=>'PostController', 'action'=>'delete'])->withParam('postId', '[0-9]+')->withMiddleware('admin'); // Supprime un article
$router->get('gestionPosts/update/:postId', ['controller'=>'PostController', 'action'=>'modify'])->withParam('postId', '[0-9]+')->withMiddleware('admin'); // Modifier un article
$router->post('gestionPosts/update/:postId', ['controller'=>'PostController', 'action'=>'update'])->withParam('postId', '[0-9]+')->withMiddleware('admin'); 
$router->get('gestionPostsShow/:postId', ['controller'=>'PostController', 'action'=>'showAdmin'])->withParam('postId', '[0-9]+')->withMiddleware('admin'); 

// gestion des commentaires
$router->get('gestionComments', ['controller'=>'CommentController', 'action'=>'all'])->withMiddleware('admin');
$router->get('gestionComments/disabled/:commentId', ['controller'=>'CommentController', 'action'=>'disabledChange'])->withParam('commentId', '[0-9]+')->withMiddleware('admin'); 
$router->get('gestionComments/delete/:commentId', ['controller'=>'CommentController', 'action'=>'delete'])->WithParam('CommentId', '[0-9]+')->withMiddleware('admin');

// gestion des utilisateurs
$router->get('gestionUsers', ['controller'=>'UserController', 'action'=>'all'])->withMiddleware('admin');
$router->get('gestionUsers/update/:userId', ['controller'=>'UserController', 'action'=>'modify'])->withParam('userId', '[0-9]+')->withMiddleware('admin');
$router->post('gestionUsers/update/:userId', ['controller'=>'UserController', 'action'=>'update'])->withParam('userId', '[0-9]+')->withMiddleware('admin');
$router->get('gestionUsers/delete/:userId', ['controller'=>'UserController', 'action'=>'delete'])->withParam('userId', '[0-9]+')->withMiddleware('admin');
$router->get('gestionUsers/updateUserType/:userId',['controller'=>'UserController', 'action'=>'updateUserType'])->withParam('userId', '[0-9]+')->withMiddleware('admin');
$router->get('gestionUsersShow/:userId', ['controller'=>'UserController', 'action'=>'show'])->withParam('userId', '[0-9]+')->withMiddleware('admin');