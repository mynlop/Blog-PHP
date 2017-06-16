<?php

namespace App\Controllers\Admin;

class PostController{
    public function getIndex(){
        // admin/posts or admin/posts/index
        global $pdo;

        $query = $pdo->prepare('SELECT * FROM  blog_posts ORDER BY id DESC');
        $query->execute();

        $blogPost = $query->fetchAll(\PDO::FETCH_ASSOC);
        return render('../Views/admin/posts.php', ["blogPost" => $blogPost]);
    }

    public function getCreate(){
        // admin/posts/create
        return render('../Views/admin/insertPost.php');
    }
    public function postCreate(){
        global $pdo;

        $sql = 'INSERT INTO blog_posts(title, content) VALUES (:title, :content)';
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'title' => $_POST['txtTitle'],
            'content' => $_POST['txtContent']
        ]);
    return render('../Views/admin/insertPost.php',['result' => $result]);
    }
}