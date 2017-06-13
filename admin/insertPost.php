<?php
    include_once '../config.php';
    $query = $pdo->prepare('SELECT * FROM  blog_posts ORDER BY id DESC');
    $query->execute();

    $blogPost = $query->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Blog 'Informatica'</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <h2>New Post</h2>
                <a class="btn btn-default" href="posts.php">Back</a>
                
                <form action="insertPost.php" method="post">
                    <div class="form-group">
                        <label for="txtTitle">Title</label>
                        <input type="text" name='txtTitle' id='txtTitle' class="form-control">
                    </div>
                    <textarea class="form-control" name="txtContent" id="txtContent" rows="5"></textarea>
                    <br>
                    <input type="submit" value="Save" class="btn btn-primary">
                </form>
            </div>
            <div class="col-md-4">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quibusdam saepe fugit consequatur autem blanditiis, aliquid tempora ullam harum, recusandae tenetur est fuga dolorem similique nihil impedit sint, iste fugiat hic.
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <footer>
                    <p>Este es el footer del sitio...</p>
                    <a href="admin/index.php">Admin Panel</a>
                </footer>
            </div>
        </div>
    </div>
</body>
</html>