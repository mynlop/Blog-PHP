<?php
// inicializar errores para el servidor
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../vendor/autoload.php';
include_once '../config.php';

$baseURL = '';
$baseDir = str_replace(basename($_SERVER['SCRIPT_NAME']),'', $_SERVER['SCRIPT_NAME']);
$baseURL = 'http://' . $_SERVER['HTTP_HOST'] . $baseDir;
define('BASE_URL', $baseURL);

$route = $_GET['route'] ?? '/';

function render($filename, $params = []){
    ob_start();
    extract($params);
    include $filename;
    return ob_get_clean();
}

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

$router->get('/admin', function(){
    return render('../Views/admin/index.php');
});

$router->get('/admin/posts', function() use ($pdo){
    $query = $pdo->prepare('SELECT * FROM  blog_posts ORDER BY id DESC');
    $query->execute();

    $blogPost = $query->fetchAll(PDO::FETCH_ASSOC);
    return render('../Views/admin/posts.php', ["blogPost" => $blogPost]);
});

$router->get('/admin/posts/create',function(){
    return render('../Views/admin/insertPost.php');
});

$router->post('/admin/posts/create', function() use ($pdo){
        $sql = 'INSERT INTO blog_posts(title, content) VALUES (:title, :content)';
        $query = $pdo->prepare($sql);
        $result = $query->execute([
            'title' => $_POST['txtTitle'],
            'content' => $_POST['txtContent']
        ]);
    return render('../Views/admin/insertPost.php',['result' => $result]);
});

$router->get('/', function() use ($pdo){
    $query = $pdo->prepare('SELECT * FROM  blog_posts ORDER BY id DESC');
    $query->execute();

    $blogPost = $query->fetchAll(PDO::FETCH_ASSOC);
    return render('../Views/index.php' , ['blogPost' => $blogPost]);
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;
