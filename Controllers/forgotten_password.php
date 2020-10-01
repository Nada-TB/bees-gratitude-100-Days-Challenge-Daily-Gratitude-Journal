<?php

if(empty($_POST)){
    $title='forgotten password';
    $template="forgottenPassword";
    include 'Views/layout.phtml';
}else{
    require_once '../Models/model_sign_up.php';
    require_once '../class/class_connexion.php';
    require_once '../class/class_account.php';

    $email=json_decode($_POST['email']);
    $account=new Account($email, null);
    if($account->verify_email($email)==true){
        $information=$account->verify_email_exists($query_get, $email);
        if( $information['email']==$email){
            $token;
           do{
               // create your token
           }while($token === $information['token']);
            
            $values=array($token, $email);
            $account->update_account($query_insert_token, $values);
            mail(
            htmlspecialchars($email),
            'Reset your password bees gratitude',
            "click the link below to reset your password"."\r\n"
            ."http://localhost/bees-gratitude/index.php?path=reset_password&&key=".$token,
            "From: infos@example.com"
            );    
            echo 'exist';
        }else{
            echo "inexistent";
        }
    }else{
        echo 'invalid email';
    }

}
