<?php

$query_get= 'SELECT * FROM users WHERE email=?';
$query_update='UPDATE users SET name=?, email=?,password=?, avatar=? WHERE email=?';
$query_update_visitor='UPDATE users SET avatar=? WHERE email=?';
$pattern=array(
    'name'=>"/^[a-zA-Z\s]+$/",
    'password'=>"/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,15}$/"
);