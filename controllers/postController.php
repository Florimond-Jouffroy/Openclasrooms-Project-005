<?php

namespace Controllers;

use Managers\{PostManager, CommentManager, UserManager};
use Entities\Post;
use App\Session;

class PostController extends Controller implements iCRUD
{
    
    private $commentManager;
    private $postManager;
    private $userManager;

    public function __construct()
    {
        parent::__construct();
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->userManager = new UserManager();
    }
    
    public function create()
    {
        return $this->render('gestionPostsNew.html');
    }

    public function store() // Traitement du formulaire et engirestement bdd
    {
        $title = $this->request->postTitle();
        $chapo = $this->request->postChapo();
        $content = $this->request->postContent();
        $user_id = Session::get('userId');
        

        if($title == '' || $chapo == '' || $content == '')
        {
            Session::flash('danger', 'Vous n\'avez pas bien remplie le formulaire !');
            $this->request->redirect($this->url('gestionPosts'));
            return;
        }
        else
        {
            $post = new Post($_POST);
            $post->setUser_id($user_id);

            $this->postManager->create($post);

            Session::flash('success', 'Article ajouter.');
            $this->request->redirect($this->url('gestionPosts'));
        }
    }

    public function delete($id)
    {
        $this->commentManager->deleteByPostId($id); // suppression des commentaires lié au post
        $this->postManager->delete($id); // suppression du post

        Session::flash('success', 'Article supprimer.');
        $this->request->redirect($this->url('gestionPosts'));
    }

    public function modify($id)
    {
        $post = $this->postManager->getPostById($id);
        $auteurs = $this->userManager->getAdmins();
        return $this->render('gestionPostsUpdate.html', ['post'=> $post, 'auteurs'=>$auteurs]);
    }

    public function update($id)
    {
        $title = $this->request->postTitle();
        $chapo = $this->request->postChapo();
        $content = $this->request->postContent();
        $user_id = $this->request->postAuteur();
        

        if($title == ''|| $chapo == '' || $content == '')
        {
            Session::flash('danger', 'Vous n\'avez pas bien remplie le formulaire !');
            header('location: '.$this->url('gestionPosts'));
            return;
        }
        else
        {
            $post = $this->postManager->getPostById($id);

            $post->setTitle($title);
            $post->setChapo($chapo);
            $post->setContent($content);
            $post->setUser_id($user_id);
            
            $this->postManager->update($post);

            Session::flash('success', 'Article Modifié.');
            $this->request->redirect($this->url('gestionPosts'));
        }
    }

    public function show($id)
    {
        $post = $this->postManager->getPostById($id);
        $user = $this->userManager->getUserById($post->user_id());
        $comments = $this->commentManager->getCommentsByPost($id);
        return $this->render('post.html', compact('post','user','comments'));
    }

    public function showAdmin($id)
    {
        $post = $this->postManager->getPostById($id);
        $user = $this->userManager->getUserById($post->user_id());
        $comments = $this->commentManager->getCommentsByPost($id);

        return $this->render('gestionPostsShow.html', compact('post','user','comments'));
    }

    public function all()
    {
        $posts = $this->postManager->getPostsWithAuteur();
        return $this->render('blog.html', ['posts'=> $posts]);
    }

    public function allAdmin()
    {
        $posts = $this->postManager->getPostsWithAuteur();
        return $this->render('gestionPosts.html', ['posts'=> $posts]);
    }
}