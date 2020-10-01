<?php

require_once 'Models/model_get_posts.php';
require_once 'class/class_post.php';
require_once 'class/class_connexion.php';

if(!empty($_SESSION)){
    $post=new Post(null, intval($_SESSION['id']));
    $posts=$post->get_all_posts($query_get);
    $title="landing page";
    $template='landingPage';
    include('Views/layout.phtml');
    
}else{
    header('location:home');
    exit();
}
 