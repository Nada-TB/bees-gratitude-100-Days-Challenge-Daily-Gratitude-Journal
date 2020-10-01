<?php
session_start();
require_once 'class/class_router.php';
$template=[
'homePage',
'sign_up', 
'landing_page', 
'login', 
'forgotten_password', 
'reset_password', 
'log_out', 
'write_post', 
'show_post',
'delete_account'];

if(http_response_code()==200){
  $router=new Router('homePage', $template, 'path');
  $router->getTemplate();
}

