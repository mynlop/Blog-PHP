<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPost;
use Sirius\Validation\Validator;

class PostController extends BaseController{
    public function getIndex(){
        // admin/posts or admin/posts/index
        $blogPost = BlogPost::all();
        return $this->render('admin/posts.twig', ["blogPost" => $blogPost]);
    }

    public function getCreate(){
        // admin/posts/create
        return $this->render('admin/insertPost.twig');
    }
    public function postCreate(){
        $errors = [];
        $result = false;
        $validator = new Validator();
        $validator->add('txtTitle','required');
        $validator->add('txtContent', 'required');

        if($validator->validate($_POST)){
            $blogPost = new BlogPost([
                'title' => $_POST['txtTitle'],
                'content' => $_POST['txtContent']
            ]);
            if($_POST['txtImg']){
                $blogPost->img_url = $_POST['txtImg'];
            }

            $blogPost->save();
            $result = true;
        }else{
            $errors = $validator->getMessages();
        }

        
    return $this->render('admin/insertPost.twig',[
        'result' => $result,
        'errors' => $errors
    ]);
    }
}