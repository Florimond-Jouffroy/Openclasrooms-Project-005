<?php 

namespace Controllers;

use App\Session;
use Managers\UserManager;
use Entities\User;


class AuthController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->userManager = new UserManager();
    }

    /**
     * Affiche la page de connexion
     */
    public function login(){
        return $this->render('login.html');
    }

    /**
     * Permet de déconnecter l'utilisateur
     */
    public function deconnexion()
    {
        if(Session::has('login'))
        {
            Session::destroy();
            $this->request->redirect($this->url('home'));
            return;
        }
        else
        {
            $this->request->redirect($this->url('home'));
        }
    }

    /**
     * Récupérer les champs du formulaire de connexion et gére la connexion de l'utilisateur
     */
    public function connexion()
    {
        // récupération des champ du formulaire de connexion
        $login = $this->request->postLogin();
        $password = $this->request->postPassword();

        // création d'un utilisateur en fonction du login
        $user = $this->userManager->getUserByLogin($login);
        
        // vérification qu'il y a bien un utilisateur avec ce login
        if($user == false)
        {
            Session::flash('danger', 'Votre login n\'est pas bon !');
            $this->request->redirect($this->url('login'));
        }
        
        // vérification que le mot de passe corespond bien a celui enregistrer dans la base
        if(password_verify($password, $user->password() ))
        {

            Session::put('login', true);
            Session::put('firstname',$user->firstname());
            Session::put('lastname',$user->lastname());
            Session::put('userId',$user->id());
            Session::put('user_type', $user->user_type());
            Session::flash('success', 'Vous êtes bien connecté');

            
            $this->request->redirect($this->url('home'));
        }
        else
        {
            Session::flash('danger', 'Votre mot de passe n\'est pas correct');
            $this->request->redirect($this->url('login'));
        }

    }




}