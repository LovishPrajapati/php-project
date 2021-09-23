<?php
$dbusername = "root";
$dbpass = "";
$ser = "localhost";
$dbname = "php_prac"; 
$conn = mysqli_connect($ser,$dbusername,$dbpass);
if( mysqli_connect_errno()){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 

$result = mysqli_query($conn,"CREATE DATABASE IF NOT EXISTS `php_prac`");
mysqli_select_db($conn,$dbname);
$result1 = mysqli_query($conn, "CREATE TABLE IF NOT EXISTS user_data(    
    username varchar(10) not null,    
    name varchar(20) not null,    
    address varchar(50),    
    email varchar(20) not null,    
    phone bigint(10) not null,   
    passwrd varchar(12) not null,    
    PRIMARY KEY(username),    
    UNIQUE(email),UNIQUE(phone) )");
?>