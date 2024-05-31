<?php
$login = false;
if(isset($_GET['loggedin']))
{
    $login = true;
}
else
{
    $login = false;
}

if($login){
session_start();
session_unset();
session_destroy();
header("location:login.php?loggedout=true");
die("location:login.php");
exit();
}
else
{
header("location:login.php?notloggedin=true");
die("location:login.php");
exit();
    
}
?>