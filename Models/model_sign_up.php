<?php

$query_get='SELECT * FROM users WHERE email= ?';
$query_get_all_users='SELECT * FROM users';
$query_insert='INSERT INTO users(name, email, password) VALUES(?,?,?)';
$query_insert_token='UPDATE users set token =? WHERE email=?';