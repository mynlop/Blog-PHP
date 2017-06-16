<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BlogPost;

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
        $blogPost = new BlogPost([
            'title' => $_POST['txtTitle'],
            'content' => $_POST['txtContent']
        ]);
        $blogPost->save();
        $result = true;
        
    return $this->render('admin/insertPost.twig',['result' => $result]);
    }
}