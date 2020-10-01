<?php
session_start();

if(isset($_SESSION['time'])){
    if(isset($_POST['timer'])){
        $timer=json_decode($_POST['timer'],false);
        if($timer>=600){
            session_destroy();
            echo 'expired';
        }
    }
}else{
    echo "not connected";
}

