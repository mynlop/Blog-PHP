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
$router->get('/', function() use ($pdo){
    $query = $pdo->prepare('SELECT * FROM  blog_posts ORDER BY id DESC');
    $query->execute();

    $blogPost = $query->fetchAll(PDO::FETCH_ASSOC);
    return render('../Views/index.php' , ['blogPost' => $blogPost]);
});

$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());
$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $route);

echo $response;
