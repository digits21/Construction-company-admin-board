<?php
if(!empty($_SESSION['id']))
{
$session_uid=$_SESSION['id'];
include('userClass.php');
$userClass = new userClass();
}
if(empty($session_uid))
{
$url=BASE_URL.'index.php';
header("Location: $url");
}
?>