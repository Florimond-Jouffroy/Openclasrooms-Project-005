<?php

namespace Controllers;

use App\{Session, Request};
/**
 * Classe abstraite Controller
 * Fournit des services commun pour les autres classes controllers dérivées
 */
abstract class Controller
{

    protected $twig;
    protected $request;

    /**
     * Constructeur
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem('../views');
        $this->twig = new \Twig_Environment($loader, [

            'cache' => false, //'.\tmp',
            'auto_reload' => true,

        ]);

        $this->request = new Request();
        /**
         * fonction twig pour réécrit l'url
         */
        $url = new \Twig_SimpleFunction('url', function($url, $args = null) {
           return $this->url($url, $args);
        });

        /**
         * fonction twig pour message flash
         */
        $flash = new \Twig_SimpleFunction('flash', function(){

            if(Session::hasFlash()){
                $texte =  '<div class="my-4 alert alert-'.Session::getFlashType() .'">'. Session::getFlash() . '</div>';
                Session::delete('flash');
                return $texte;
            }

        });

        /**
         * fonction twig qui retourne true si l'utilisateur est connecter
         */
        $auth = new \Twig_SimpleFunction('auth', function(){

            return Session::has('login');

        });

        $isAdmin = new \Twig_SimpleFunction('isAdmin', function(){

            return (Session::has('user_type') && Session::get('user_type') == 1);

        });

        $this->twig->addFunction($auth);
        $this->twig->addFunction($flash);
        $this->twig->addFunction($url);
        $this->twig->addFunction($isAdmin);
    }
    

    /**
     * @param string $twigFile Nom de la page html
     * @param array $parameters Tableau de données à transmettre a la page
     */
    protected function render(string $twigFile, array $parameters = null)
    {

        try {
            if($parameters != null)
                echo $this->twig->render($twigFile, $parameters);
            else
                echo $this->twig->render($twigFile);
        } catch (\Exception $e) {
            var_dump($e);
            return false;
        }
        return true;
    }

    protected function url($url, $args = null) 
    {
        $path = getenv('ENV_URL').'/'.$url;

        if($args !== null) {
            if(is_array($args)) {
                if(substr($url, -1) != '/')
                    $path .= '/';
                foreach($args as $arg)
                {
                    $path .= $arg;
                    $path .= '/';
                }
            } else {
                throw new \InvalidArgumentException("args is not array");
            }
        }

        return $path;
    }
       

}