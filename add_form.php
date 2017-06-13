<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>
<style type="text/css">
#dis{
	display:none;
}
    #myframe
    {
        display: block;
        
        
}
    iframe{
        display: block;
        width: 1135px;
        height: 400px; 
        padding-left: 200px;
        padding-right: 200px
    }
</style>


	
    
    <div id="dis">
    <!-- here message will be displayed -->
	</div>

<div id="myframe" >
    <iframe src="result.php">
    
    </iframe>
        
    </div>

<h1>Enregistrer le Nouveau Client</h1>
<div>
 	
	 <form method='post' id='emp-SaveForm' action="create_client.php">
         <?php
         
         $nom_devis=isset($_POST['nme_dev'])?$_POST['nme_dev']:false;
         $dev_cat=isset($_POST['categorie_dev'])?$_POST['categorie_dev']:false;
         $nombre_cimt=isset($_POST['mycimt'])?$_POST['mycimt']:false;
         $volume_sable=isset($_POST['mysable'])?$_POST['mysable']:false;
         $volume_gravier=isset($_POST['mygravier'])?$_POST['mygravier']:false;
         $brique=isset($_POST['mybrique'])?$_POST['mybrique']:false;
         $main_doeuvre=isset($_POST['myoeuvre'])?$_POST['myoeuvre']:false;
         $montan_ciment=isset($_POST['mymntciment'])?$_POST['mymntciment']:false;
         $montan_sable=isset($_POST['mymntsable'])?$_POST['mymntsable']:false;
         $montan_gravier=isset($_POST['mymntgravier'])?$_POST['mymntgravier']:false;
         $montan_brique=isset($_POST['mymntbrique'])?$_POST['mymntbrique']:false;
         $total_montan=isset($_POST['mytotal'])?$_POST['mytotal']:false;
        
         echo'<input type="hidden" name="devis_nom" value="'.$nom_devis.'"/>';
         echo'<input type="hidden" name="categorie_devis" value="'.$dev_cat.'"/>';
         echo'<input type="hidden" name="nombre_ciment" value="'.$nombre_cimt.'"/>';
         echo'<input type="hidden" name="volume_sable" value="'.$volume_sable.'"/>';
         echo'<input type="hidden" name="volume_gravier" value="'.$volume_gravier.'"/>';
         if($dev_cat=='devis_mur')
         {
              //echo $brique;
             //echo $montan_brique;
             echo'<input type="hidden" name="nombre_brique" value="'.$brique.'"/>';
             echo'<input type="hidden" name="montan_brique" value="'.$montan_brique.'"/>';
         }
        // echo $montan_ciment;
         echo'<input type="hidden" name="maindoeuvre" value="'.$main_doeuvre.'"/>';
         echo'<input type="hidden" name="montant_ciment" value="'.$montan_ciment.'"/>';
         echo'<input type="hidden" name="montan_sable" value="'.$montan_sable.'"/>';
         echo'<input type="hidden" name="montan_gravier" value="'.$montan_gravier.'"/>';
         echo'<input type="hidden" name="montan_total" value="'.$total_montan.'"/>';
         
        
 ?>
    <table class='table table-bordered' id="add-table">
 
        <tr>
            <td>Nom </td>
            <td><input type='text' name='nom_cli' class='form-control' placeholder='EX : john doe' required /></td>
        </tr>
 
        <tr>
            <td>Prenom</td>
            <td><input type='text' name='prenom_cli' class='form-control' placeholder='' required></td>
        </tr>
 
        <tr>
            <td>Telephone</td>
            <td><input type='tel' name='tel_cli' class='form-control' placeholder='EX :+226 76xxxxxx' required></td>
        </tr>
        <tr>
            <td>No CNIB</td>
            <td><input type='number' name='carte_id' class='form-control' placeholder='8 charaters' required></td>
        </tr>
        <tr>
            <td>Montant Total a Payer </td>
            <td><input type='number' name='total'value="<?php if(isset($_POST['mytotal'])){echo $_POST['mytotal'];}?>" class='form-control' placeholder='EX : 180000' required></td>
        </tr>
        <tr>
            <td>Montant Paye</td>
            <td><input type='text' name='paye' class='form-control' placeholder='EX : 1800' required></td>
        </tr>
        
        <tr>
            <td>Date de Debut du Contrat</td>
            <td><input type='text' name='date_deb' class='form-control' placeholder='EX : 27/12/2016' required></td>
        </tr>
        <tr>
            <td>Dernier delai de paiement </td>
            <td><input type='text' name='date_fin' class='form-control' placeholder='EX : 27/12/2017' required></td>
        </tr>
        
 
        <tr>
            <td colspan="2">
            <button type="submit" class="btn btn-primary" name="save" id="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Sauvergarder
			</button>  
            </td>
        </tr>
 
    </table>
</form>
    </div>
     
