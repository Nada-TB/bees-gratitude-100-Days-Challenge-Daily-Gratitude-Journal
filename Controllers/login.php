<?php

require_once '../Models/model_login.php';
require_once '../class/class_connexion.php';
require_once '../class/class_account.php';

if(!empty($_POST)){
    $data=json_decode($_POST['data'],false);
    $form_information= array(
        'email'=>$data->email,
        'password'=>$data->password
    );

    $account=new Account($form_information, null);
    $response=$account->connect_account($query_get,'landing_page');  
    echo $response;    
}