<?php
require_once 'class/class_connexion.php';
require_once 'class/class_account.php';

$account=new Account($_SESSION, null);
$account->log_out('home');