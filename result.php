<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

    table.myResultTable{
        border-collapse: separate;
        border-spacing: 20px;
    }
</style>

<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>

<h3>Devis</h3>
<form method="post" action="">
<table class="table table-bordered">
    
      <tr>
            <td>Nom </td>
            <td><input type='text' name='nom_dev' class='form-control' placeholder='EX :devis de xx' required /></td>
        </tr>
       <tr>
            <td>Categorie du Devis </td>
            <td><label>Choisir le Devis <span>*</span></label>
					<select class="" name="devis">
					<option value="devis_mur">Mur</option>
					  <option value="devis_crepis">Crepissage</option>
            </td>
        </tr>
        <tr>
            <td>Volume </td>
            <td><input type='number' name='vol' class='form-control' placeholder='En m3' required /></td>
        </tr>
    <tr>
            <td>Dosage </td>
            <td><input type='number' name='dosage' class='form-control' placeholder='' /></td>
        </tr>
    <tr>
            <td>Surface Maconnee</td>
            <td><input type='number' name='surface' class='form-control' placeholder='En m2' required /></td>
        </tr>
    <tr>
            <td>Main D'oeuvre </td>
            <td><input type='number' name='main_deovre' class='form-control' placeholder='EX : 8000' required /></td>
        </tr>
    <tr>
    <td>
        <a href="#myResult"><button type="submit" class="btn btn-primary" name="save_devis" id="calcul" target="">
        <span class="glyphicons glyphicons-disk-saved"></span> Faites le Calcul
        </button></a>
    </td>
    
    </tr>
    </table>

</form>
<?php
//$save_dev=isset($_POST['save_devis'])?$_POST['save_devis']:false;
if(isset($_POST['save_devis']))
{
    
$vol=isset($_POST['vol'])?$_POST['vol']:false;
$dos=isset($_POST['dosage'])?$_POST['dosage']:false;
$surf=isset($_POST['surface'])?$_POST['surface']:false;
$oeuvre=isset($_POST['main_deovre'])?$_POST['main_deovre']:false;

$devi_cat=isset($_POST['devis'])?$_POST['devis']:false;
$nom=isset($_POST['nom_dev'])?$_POST['nom_dev']:false;


    

if(!empty($vol))
{
    $vol_sable= $vol*0.4;
    $vol_gravier=$vol*0.8;
    $mnt_sab=$vol_sable*10000;
    $mnt_gravier=$vol_gravier*6250;
    
}

if(!empty($devi_cat))
{
    $nbr_cimt=0;
    if($devi_cat=='devis_mur')
    {
        $nbr_brique=($surf*13);
        $nbr_cimt=$nbr_brique/90;
       $mnt_brique=$nbr_brique*250;
        $mnt_cimt=$nbr_cimt*5000;
        $mnt_total= $mnt_brique+$mnt_cimt+$mnt_sab+$mnt_gravier+$oeuvre;
    }
    else if($devi_cat=='devis_crepis')
    {
        $nbr_cimt=($vol*$dos)/50;
        $mnt_cimt=$nbr_cimt*5000;
        $mnt_total= $mnt_cimt+$mnt_sab+$mnt_gravier+$oeuvre;
    }
     
    
    
}





    echo'<table id="myResult" class="myResultTable">';

echo'<div >';

  echo'<tr>';
    echo'<th colspan="2">Nom du devis:'.$nom.'</th>';
    echo'</tr>';
    echo'<tr>';
     echo'<td>Volume de Sable:'.$vol_sable.'</td><td>Montant:'.$mnt_sab.'</td>';
    echo'</tr>';
    echo'<tr>';
     echo'<td>Volume de Gravier:'.$vol_gravier.'</td><td>Montant:'.$mnt_gravier.'</td>';
    echo'</tr>';
    if($devi_cat=='devis_mur')
    { echo'<tr>';
        echo'<td>Nombre de Briques :'.$nbr_brique.'</td><td>Montant:'.$mnt_brique.'</td>';
     echo'</tr>';
    }
    
    echo'<tr>';
        echo'<td>Nombre de sacs de Ciments :'.$nbr_cimt.'</td><td>Montant:'.$mnt_cimt.'</td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td colspan="2">Main d\'ouevre :'.$oeuvre.'</td>';
    echo'</tr>';
    echo'<tr>';
    echo'<td colspan="2">Total:'.$mnt_total.'</td>';
    echo'</tr>';
     
    
    
echo'</div>';
    echo'</table>';
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
$("#myform2").hide();
    $("#btn3").click(function(){
        $("#myform2").fadeOut()
    });
    $("#btn2").click(function(){
        $("#myform2").fadeIn();
    });
});
</script>

<?php
echo'<form id="myform1" method="post" action="add_form.php#add-table" target="_parent">';
    echo'<input type="hidden" name="nme_dev" value="'.$nom.'"/>';
    echo'<input type="hidden" name="mycimt" value="'.$nbr_cimt.'"/>';
    echo'<input type="hidden" name="mysable" value="'.$vol_sable.'"/>';
    echo'<input type="hidden" name="mygravier" value="'.$vol_gravier.'"/>';
    if($devi_cat=='devis_mur')
    {
        echo'<input type="hidden" name="mybrique" value="'.$nbr_brique.'"/>';
        echo'<input type="hidden" name="mymntbrique" value="'.$mnt_brique.'"/>';
    }
    echo'<input type="hidden" name="myoeuvre" value="'.$oeuvre.'"/>';
    echo'<input type="hidden" name="mymntciment" value="'.$mnt_cimt.'"/>';
    echo'<input type="hidden" name="mymntsable" value="'.$mnt_sab.'"/>';
    echo'<input type="hidden" name="mymntgravier" value="'.$mnt_gravier.'"/>';
    echo'<input type="hidden" name="mytotal" value="'.$mnt_total.'"/>';
     echo'<input type="hidden" name="categorie_dev" value="'.$devi_cat.'"/>';
echo'<button id="btn1" class="btn btn-primary" name="mynewuser" >Nouveau Client</button>';
    echo'</form>';
echo'<button id="btn2" class="btn btn-primary">Ancien Client</button>';
echo'<button id="btn3" class="btn btn-primary">Cacher</button>';
  
echo'<form id="myform2" method="post" action="create.php" target="_parent">';
    echo'<input type="hidden" name="nme_dev" value="'.$nom.'"/>';
    echo'<input type="hidden" name="mycimt" value="'.$nbr_cimt.'"/>';
    echo'<input type="hidden" name="mysable" value="'.$vol_sable.'"/>';
    echo'<input type="hidden" name="mygravier" value="'.$vol_gravier.'"/>';
    if($devi_cat=='devis_mur')
    {
        echo'<input type="hidden" name="mybrique" value="'.$nbr_brique.'"/>';
        echo'<input type="hidden" name="mymntbrique" value="'.$mnt_brique.'"/>';
    }
    echo'<input type="hidden" name="myoeuvre" value="'.$oeuvre.'"/>';
    echo'<input type="hidden" name="mymntciment" value="'.$mnt_cimt.'"/>';
    echo'<input type="hidden" name="mymntsable" value="'.$mnt_sab.'"/>';
    echo'<input type="hidden" name="mymntgravier" value="'.$mnt_gravier.'"/>';
    echo'<input type="hidden" name="mytotal" value="'.$mnt_total.'"/>';
    echo'<input type="hidden" name="categorie_dev" value="'.$devi_cat.'"/>';
echo'<input type="number" name="mycnib"placeholder="No CNIB"/>';
echo'<button type="submit" name="mynewdevis" class="btn btn-primary">Ajouter le devis</button>';
echo'</form>';

    
  
}
   ?> 