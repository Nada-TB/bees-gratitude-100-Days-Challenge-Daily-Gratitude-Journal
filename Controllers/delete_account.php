<?php
require_once 'class/class_connexion.php';
require_once 'class/class_account.php';
require_once 'class/class_post.php';
require_once 'Models/model_delete_account.php';

if(!empty($_SESSION)){
    if(empty($_POST)){
        $title= "delete account";
        $template="deleteAccount";
        include 'Views/layout.phtml';
    }else{
        if(!empty($_POST['data'])){
            if($_SESSION['email'] === "visitor@example.com"){
                echo 'you are not allowed to delete this account, you are just a visitor dude';
            }else{
                $data=json_decode($_POST['data']);
                $account=new Account($data, null);
                $post=new Post(null, $_SESSION['id']);
                if($account->verify_email($data->email) == true){
                    $user=$account->verify_email_exists($query_get, htmlspecialchars($_SESSION['email']));
                    if($data->email === $user['email'] && $account->check_password($data->password, $user['password']) == true){
                        $post->delete_post($query_delete_posts, $user['id_user']);
                        $account->update_account($query_delete_user, [$user['id_user']]); 
                        session_unset();
                        mail(
                            htmlspecialchars($user['email']),
                            'bees gratitude account deleted',
                            "your profil has been successfully deleted!",
                            "From: infos@example.com"
                        );
                        echo 'done';
                    }else{
                        if($account->check_password($data->password, $user['password'])==false){
                            echo 'incorrect password';
                        }else{
                            echo "incorrect email";
                        }
                    }
                }else{
                    echo 'invalid email';
                }    
            }  
        }else{
            echo 'empty form';
        }
    }
}else{
    header('location:index.php');
    exit();
}
