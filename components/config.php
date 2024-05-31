<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "forum";

$conn = mysqli_connect($host,$username,$password,$database);

if(!$conn){
    die("Cannot connect to dabatase -->>".mysqli_connect_error());
}

?>