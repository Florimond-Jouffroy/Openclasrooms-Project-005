<?php 

namespace Controllers;


class ErrorController extends Controller
{
    public function error404()
    {
        $errorType = '404';
        $message = 'La page que vous chercher semble introuvable.';
        return $this->render('error.html', ['type'=>$errorType, 'message'=>$message]);
    }

    public function error403()
    {
        $errorType = '403';
        $message = 'Accés a la page';
        return $this->render('error.html', ['type'=>$errorType, 'message'=>$message]);
    }

    
}