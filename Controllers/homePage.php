<?php

if(empty($_SESSION)){
    $title="Home page";
    $template="homePage";
    include 'Views/layout.phtml';
}else{
    header('location:landing_page');
    exit();
}
