<?php

namespace App\Controllers;
use Twig_Loader_Filesystem;
class BaseController{
    protected $templateEngine;

    public function __construct(){
        $loader = new Twig_Loader_Filesystem('../Views');
        $this->templateEngine = new \Twig_Environmente($loader, [
            'debug' => true,
            'cache' => false
        ]);
    }    
    public function render($fileName, $data = []){
        return $this->templateEngine->render($fileName, $data);
    }
}