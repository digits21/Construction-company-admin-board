<?php
include_once 'connect.php';
$db=fetDB();
if($_POST['del_id'])
{
	$id = $_POST['del_id'];	
	$stmt=$db->prepare("DELETE FROM users WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
}
?>