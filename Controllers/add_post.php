<?php
session_start();

require_once '../class/class_post.php';
require_once '../class/class_connexion.php';
require_once '../Models/model_add_post.php';

$content=json_decode($_POST['content']);
   
$post=new Post($content, $_SESSION['id']);
$posts=$post->get_all_posts($query_get);
if(COUNT($posts)==100){
    echo "you have attained your maximum posts authorized, sorry, you can't post any more!";
}else{
    $post->add_post($query_insert);
    echo "added";  
}
