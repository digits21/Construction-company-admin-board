<?php
require_once 'connect.php';

	
	if($_POST)
	{
        $db=getDB();
		$id = $_POST['id'];
		$new_montant = $_POST['new_montant'];
		$montant_due=$_POST['montant_due'];
        
        $req=$db->prepare("SELECT montant_paye FROM users WHERE id=:id");
		$req->bindParam(":id",$id);
        $row=$req->fetch(PDO::FETCH_ASSOC);
        $dejaverser=$row['montant_paye'];
        $totalverser=$new_montant+$dejaverser;
        $restant=$montant_due-$totalverser;
        echo $restant;
		$stmt = $db->prepare("UPDATE users SET montant_paye=:new_paye,montant_restant=:restant WHERE id=:id");
		$stmt->bindParam(":new_paye", $new_montant);
        $stmt->bindParam(":restant", $restant);
		$stmt->bindParam(":id", $id);
		
		if($stmt->execute())
		{
			echo "Successfully updated";
            
            header("Location:Home.php");
		}
		else{
			echo "Query Problem";
		}
	}

?>