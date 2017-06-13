<?php
include("connect.php");
include('userClass.php');
$userClass = new userClass();

$errorMsgReg='';
$errorMsgLogin='';
/* Login Form */
if (!empty($_POST['submit'])) 
{
$usernameEmail=$_POST['email'];
$password=$_POST['pass'];
if(strlen(trim($usernameEmail))>1 && strlen(trim($password))>1 )
{
$uid=$userClass->userLogin($usernameEmail,$password);
if($uid)
{
$url=BASE_URL;
header("Location: $url"); // Page redirecting to home.php 
}
else
{
echo"Please check login details.\n";
   // echo $uid->errorInfo()[2];
    
}
}
}
?>