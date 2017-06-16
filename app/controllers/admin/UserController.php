<?php

namespace  App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\User;
use Sirius\Validation\Validator;

class UserController extends BaseController{
    public function getIndex(){
        $users = User::all();
        return $this->render('admin/Users.twig',[
            'users' => $users
        ]);
    }

    public function getCreate(){
        return $this->render('admin/insertUser.twig');
    }

    public function postCreate(){
        $errors = [];
        $result = false;

        $validator = new Validator();
        $validator->add('txtName', 'required');
        $validator->add('txtEmail', 'required');
        $validator->add('txtEmail', 'email');
        $validator->add('txtPassword', 'required');
        
        if($validator->validate($_POST)){
            $user = new User();
            $user->name = $_POST['txtName'];
            $user->email = $_POST['txtEmail'];
            $user->password = password_hash($_POST['txtPassword'], PASSWORD_DEFAULT);
            $user->save();
            $result = true;
        }else{
            $errors = $validator->getMessages();
        }

        return $this->render('admin/insertUser.twig',[
            'result' => $result,
            'errors' => $errors
        ]);
    }
}