<?php
// inicializar errores para el servidor
ini_set('display_errors',1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once '../config.php';

$route = $_GET['route'] ?? '/';

switch ($route){
    case '/':
        require '../index.php';
        break;
    case '/admin':
        require '../admin/index.php';
        break;
    case '/admin/posts.php':
        require '../admin/posts.php';
        break;
}