<?php
include_once 'connect.php';

if($_GET['edit_id'])
{
    $db=getDB();
	$id = $_GET['edit_id'];	
	$stmt=$db->prepare("SELECT * FROM users WHERE id=:id");
	$stmt->execute(array(':id'=>$id));	
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
}

?>
<style type="text/css">
#dis{
	display:none;
}
</style>


	
    
    <div id="dis">
    
	</div>
        
 	
	 <form method='post' id='emp-UpdateForm' action='update.php'>
 
    <table class='table table-bordered'>
 		<input type='hidden' name='id' value='<?php echo $row['id']; ?>' />
        <input type='hidden' name='montant_restant' value='<?php echo $row['montant_restant']; ?>' />
        <input type='hidden' name='montant_due' value='<?php echo $row['montant_due']; ?>' />
        <tr>
            <td>Nom du Client</td>
            <td><input type='text' name='emp_name' class='form-control' value='<?php echo $row['nom']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Prenom</td>
            <td><input type='text' name='emp_dept' class='form-control' value='<?php echo $row['prenom']; ?>' required></td>
        </tr>
 
        <tr>
            <td>Nouveau Montant Verse </td>
            <td><input type='text' name='new_montant' class='form-control' value='<?php echo $row['montant_paye']; ?>' required></td>
        </tr>
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="btn-update" id="btn-update">
    		<span class="glyphicon glyphicon-plus"></span> Ajouter le nouveau versement
			</button>
            </td>
        </tr>
 
    </table>
</form>
     
