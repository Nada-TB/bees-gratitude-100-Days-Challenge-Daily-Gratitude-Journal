<?php

$query_get='SELECT token, email FROM users WHERE email=?';
$query_update='UPDATE users set password=?, token=? WHERE email=?';
