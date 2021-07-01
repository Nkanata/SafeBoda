<?php

$db_name = "SafeBoda";
$user = "trouble";
$pass = "@trouble";
$host = "localhost";

@$db = mysqli_connect($host, $user, $pass, $db_name);

if (mysqli_connect_errno()){
    echo "Error could not connect to the Database \n Please Try again later";
}