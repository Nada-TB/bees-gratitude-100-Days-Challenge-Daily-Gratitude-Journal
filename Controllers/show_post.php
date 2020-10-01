<?php

require_once 'class/class_post.php';
require_once 'class/class_connexion.php';
require_once 'Models/model_show_post.php';

$post=new Post(null, intval($_SESSION['id']));
$value=$post->get_post($query_get, intval($_GET['id']));

if(!empty($_GET['id']) && intval($_GET['id']) === intval($value['id']) ){
    $title= "Post number ".$value['id'];
    $template="showPost";
    include 'Views/layout.phtml';
}else{
    header("location:errors/error.html");
    exit();
    
}