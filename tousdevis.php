<?php

require_once 'connect.php';

$db=getDB();

$stmt=$db->prepare("SELECT client.nom client, devis.nom_devis mur_nom, devis.ciment nombre_ciment,devis.sable volume_sable, devis.gravier volume_gravier, devis.brique nombre_brique, devis.main_doevre oeuvre,devis.montan_ciment mnt_ciment, devis.montan_sable mnt_sable, devis.montan_gravier mnt_gravier,devis.montan_brique mnt_brique FROM  users client INNER JOIN devis_mur devis  WHERE client.carte_id=devis.user_id ORDER BY devis.id");

if(!$stmt->execute())
{
    echo $stmt->errorInfo()[2];
}

else
{ echo '<table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">';
    echo'<tr>';
        echo'<th>Nom du Client</th>';
        echo'<th>Nom du devis</th>';
        echo'<th>Nombre de Brique</th>';
        echo'<th>Montant des Briques</th>';
        echo'<th>Volume du Sable</th>';
        echo'<th>Montant du Sable </th>';
        echo'<th>Nombre de Sacs de Ciment </th>';
        echo'<th>Montant du Ciment </th>';
        echo'<th>Volume du Gravier</th>';
        echo'<th>Montant des Gravier </th>';
        echo'<th>Main D\'oeuvre</th>';
        echo'</tr>';
    while($row=$stmt->fetch())
    {
       
        
        echo'<tr>';
        echo '<td>'.$row['client'].'</td>';
        echo '<td>'.$row['mur_nom'].'</td>';
        echo '<td>'.$row['nombre_brique'].'</td>';
        echo '<td>'.$row['mnt_brique'].'</td>';
        echo '<td>'.$row['volume_sable'].'</td>';
        echo '<td>'.$row['mnt_sable'].'</td>';
        echo '<td>'.$row['nombre_ciment'].'</td>';
        echo '<td>'.$row['mnt_ciment'].'</td>';
        echo '<td>'.$row['volume_gravier'].'</td>';
        echo '<td>'.$row['mnt_gravier'].'</td>';
        echo '<td>'.$row['oeuvre'].'</td>';
        echo'</tr>';
        
        
    }
 echo'</table>';
    
}

?>