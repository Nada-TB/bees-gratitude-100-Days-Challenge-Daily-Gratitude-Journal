<?php
require_once 'Models/model_sign_up.php';
require_once 'class/class_connexion.php';
require_once 'class/class_account.php';

if(!empty($_POST)){
    $form_information=array(
        'name'=> $_POST['name'],
        'email'=> $_POST['email'],
        'password'=>$_POST['password']
    );
    
    $pattern= array(
        'name'=>"/^[a-zA-Z\s]+$/",
        'password'=>"/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,15}$/"
    );
    
    $account=new Account($form_information, $pattern);
    $users=$account->get_all_users($query_get_all_users);
    if(COUNT($users) == 50){
        $response="Sign up is close, sorry!";
        header('location:index.php?path=homePage&&error='.$response);
        exit();
    }else{
        $response=$account->create_account($query_insert, $query_get);
            switch($response){
                case 'account created':
                header('location: index.php?path=homePage&&message='.$response);
                exit();
            break;
            default:
                header('location:index.php?path=homePage&&error='.$response);
                exit();
            break;  
        }
    }   
}

