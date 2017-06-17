<?php

namespace App\Controllers;

use Sirius\Validation\Validator;
use App\Models\User;
use App\Log;

class AuthController extends BaseController{
    public function getLogin(){
        return $this->render('login.twig');
    }

    public function postLogin(){
        $validator = new Validator();
        $validator->add('txtEmail','required');
        $validator->add('txtEmail','email');
        $validator->add('txtPassword','required');

        if($validator->validate($_POST)){
            $user = User::where('email', $_POST['txtEmail'])->first();
            if($user){
                if (password_verify($_POST['txtPassword'], $user->password)){
                    // el usuario se autentico con exito
                    $_SESSION['userId'] = $user->id;
                    Log::logInfo('Login userId: ' .$user->id);
                    header('Location: ' . BASE_URL . 'admin');
                    return false;
                }
            }
            // no esta el usuario
            $validator->addMessage('Error','Email and/or password does not match');
        }

        $errors = $validator->getMessages();
        
        return $this->render('login.twig',[
            'errors' => $errors
        ]);
    }

    public function getLogout(){
        Log::logInfo('Logout userId: ' . $_SESSION['userId']);
        unset($_SESSION['userId']);
        header('Location: ' . BASE_URL . 'auth/login');
    }
}