<?php

require_once 'Models/model_get_posts.php';
require_once 'class/class_post.php';
require_once 'class/class_connexion.php';


if(!empty($_SESSION)){
    $post=new Post(null, intval($_SESSION['id']));
    $posts=$post->get_all_posts($query_get);
    //check if a post has been written today
    if(!empty($posts) && substr($posts[0]['date_publication'],0,10) === date("Y-m-d")){
        $title= 'daily bee\'s gratitude';
        $template='forbiddenWritePost';
        include 'Views/layout.phtml';   
    }else{
        if(empty($_POST)){
            $title= 'daily bee\'s gratitude';
            $template='writePost';
            include 'Views/layout.phtml';
        }
    }      
}else{
    header('location:homePage');
    exit();
}
