<?php
session_start();
require_once '../Models/model_update_profil.php';
require_once '../class/class_connexion.php';
require_once '../class/class_account.php';

if(isset($_POST['data'])){
    $data=json_decode($_POST['data'],false);
    $old_password=$data->oldPassword;
    $information=array(
        'name'=>$data->name,
        'email'=>$data->email,
        'password'=>$data->password
    );

    $account=new Account($information,$pattern);
    $user=$account->verify_email_exists($query_get, $_SESSION["email"]);
    $check_email=$account->verify_email_exists($query_get, $information['email']);
    
    if(isset($_FILES['file'])){
        //delete the previous image from the server
        if($user['avatar'] !== "/css/images/avatar.png"){
            unlink($_SERVER['DOCUMENT_ROOT']."/bees-gratitude".$user['avatar']);
        }
        $avatar=$_FILES['file']['name'];
        $path='/css/images/'.$avatar;
        $destination=$_SERVER['DOCUMENT_ROOT']."/bees-gratitude".$path;
        move_uploaded_file($_FILES['file']['tmp_name'], $destination);
    }else{
        $path="/css/images/avatar.png";
    }

    if($account->check_password($old_password,$user['password'])==true){
       $validation=$account->check_all_values_equal($account->check_values());
       if($validation==true){
           if($user['email'] !== "visitor@example.com"){
               if( $information['email'] !== $check_email['email'] || $user['email']==$information['email']){
                    $information['password']=$account->hash_password($information['password']);
                    $values=array(
                        $information['name'],
                        $information['email'],
                        $information['password'],
                        $path,
                        $user['email']
                    );
                    $account->update_account($query_update, $values);
                    mail(
                        htmlspecialchars($user['email']),
                        'bees gratitude account updated',
                        "your profil has been successfully updated!",
                        "From: infos@example.com"
                    );

                    $_SESSION['name']=$data->name;
                    $_SESSION['email']=$data->email;
                    $_SESSION['avatar']=$path;
                    echo 'account updated';
               }else{
                   echo "you can't update your profil with this email, it belongs to another account";
               }      
           }else{
                $account->update_account($query_update_visitor, [$path, $user['email']]);
                $_SESSION['avatar']=$path;
                echo 'account updated';
           }         
       }else{
           echo $account->send_errors_form();
       }
    }else{
        echo "your old password isn't correct, you aren't allowed to upadate this profil";
    }

}