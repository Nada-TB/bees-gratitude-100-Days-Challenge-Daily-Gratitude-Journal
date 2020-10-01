<?php

if(empty($_POST)){
    $title= 'reset password';
    $template="resetPassword";
    include 'Views/layout.phtml';
}else{
    require_once '../Models/model_reset_password.php';
    require_once '../class/class_connexion.php';
    require '../class/class_account.php';

    $data=json_decode($_POST['data'], false);
    $email=$data->email;
    if(isset($data->key)){
        $token=$data->key;
    }else{
        $token="";
    }
    
    $account=new Account($email, null);
    
    if($account->verify_email($email)==true){
        $information=$account->verify_email_exists($query_get, $email);
        if($information['email']== $email ){
            if($information['token']== intval($token)){
                $password=$account->hash_password($data->password);
                $new_token;
                do{
                    // create your token
                }while($new_token === $information['token']);
                
                $values=array($password, $new_token, $email);
                $account->update_account($query_update,$values);
                mail(
                htmlspecialchars($email),
                'bees gratitude password updated',
                "your password has been successfully updated!",
                "From: infos@example.com"
                );
                echo 'your password has been successfully updated!';
            }else{
                echo "you have used an invalid url, check you inbox";
            }
            
        }else{
            echo 'this email hasn\'t an account';
        }
    }else{
        echo 'invalid email';
    }

}