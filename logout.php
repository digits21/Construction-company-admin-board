<?php
include('connect.php');
$session_uid='';
$_SESSION['id']=''; 
if(empty($session_uid) && empty($_SESSION['id']))
{
$url='index.php';
header("Location: $url");
//echo "<script>window.location='$url'</script>";
}
?>