<?php
include("connect.php");
$db=getDB();
include('session.php');
$userDetails=$userClass->userDetails($session_uid);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style>
        ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

/* Float the list items side by side */
ul.topnav li {float: left;}

/* Style the links inside the list items */
ul.topnav li a {
    display: inline-block;
    color: #f2f2f2;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of links on hover */
ul.topnav li a:hover {background-color: #555;}

/* Hide the list item that contains the link that should open and close the topnav on small screens */
ul.topnav li.icon {display: none;
        }
        @media screen and (max-width:680px) {
  ul.topnav li:not(:first-child) {display: none;}
  ul.topnav li.icon {
    float: right;
    display: inline-block;
  }
}

/* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens */
@media screen and (max-width:680px) {
  ul.topnav.responsive {position: relative;}
  ul.topnav.responsive li.icon {
    position: absolute;
    right: 0;
    top: 0;
  }
  ul.topnav.responsive li {
    float: none;
    display: inline;
  }
  ul.topnav.responsive li a {
    display: block;
    text-align: left;
  }
}
    
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CTE admin Board</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script type="text/javascript" src="assets/jquery-1.11.3-jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#btn-view").hide();
	
	$("#btn-add").click(function(){
		$(".content-loader").fadeOut('slow', function()
		{
			$(".content-loader").fadeIn('slow');
			$(".content-loader").load('add_form.php');
			$("#btn-add").hide();
			$("#btn-view").show();
		});
	});
	
	$("#btn-view").click(function(){
		
		$("body").fadeOut('slow', function()
		{
			$("body").load('Home.php');
			$("body").fadeIn('slow');
			window.location.href="Home.php";
		});
	});
    
    $("#btn-devi").click(function(){
		
		$(".content-loader").fadeOut('slow', function()
		{
            $(".content-loader").fadeIn('slow');
			$(".content-loader").load('tousdevis.php');
			
			$("#btn_devi").hide();
		});
	});
    $("#btn-crepis").click(function(){
		
		$(".content-loader").fadeOut('slow', function()
		{
            $(".content-loader").fadeIn('slow');
			$(".content-loader").load('crepisdevis.php');
			
			$("#btn_crepis").hide();
		});
	});
	
});
</script>
    <script type="text/javascript">
    function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
    </script>

</head>

<body>
    
<nav>
    <ul class="topnav" id="myTopnav">
  <li><a href="#">Bienvenu</a></li>
  <li><a href="#"><?php echo $userDetails->prenom; ?></a></li>
  <li><a href="logout.php">logout</a></li>
  
  <li class="icon">
    <a href="javascript:void(0);" onclick="myFunction()">&#9776;</a>
  </li>
</ul>
    
</nav>

	<div class="container">
      
        <h2 class="form-signin-heading">Nos clients</h2><hr />
        
        
        <button class="btn btn-info" type="button" id="btn-add"> <span class="glyphicon glyphicon-pencil"></span> &nbsp;Faire un Devis et Ajouter un Client</button>
        <button class="btn btn-info" type="button" id="btn-view"> <span class="glyphicon glyphicon-eye-open"></span> &nbsp; Voir La Liste des Clients</button>
        <button class="btn btn-info" type="button" id="btn-devi"> <span class="glyphicon glyphicon-pencil"></span> &nbsp;Voir la Liste de Tous les Devis de Mur </button>
        <button class="btn btn-info" type="button" id="btn-crepis"> <span class="glyphicon glyphicon-pencil"></span> &nbsp;Voir la Liste de Tous les Devis de Crepissage </button>
        <hr />
        
        <div class="content-loader">
        
        <table cellspacing="0" width="100%" id="example" class="table table-striped table-hover table-responsive">
        <thead>
        <tr>
        <th> No CNIB</th>
        <th>Nom</th>
        <th>Prenom</th>
        <th>Telephone</th>
        <th>Montant Total Due</th>
        <th>Montant Paye</th>
        <th>Montant Restant</th>
        <th>Date de Debut du Contrat</th>
        <th>Date de fin du Contrat</th>
        
        <th>edit</th>
        <th>delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
       // require_once 'dbconfig.php';
        
        $stmt = $db->prepare("SELECT * FROM users ORDER BY nom DESC");
        $stmt->execute();
		while($row=$stmt->fetch(PDO::FETCH_ASSOC))
		{
			?>
			<tr>
			<td><?php echo $row['carte_id']; ?></td>
			<td><?php echo $row['nom']; ?></td>
			<td><?php echo $row['prenom']; ?></td>
			<td><?php echo $row['telephone']; ?></td>
            <td><?php echo $row['montant_due']; ?></td>
            <td><?php echo $row['montant_paye']; ?></td>
            <td><?php echo $row['montant_restant']; ?></td>
            <td><?php echo $row['date_debut']; ?></td>
            <td><?php echo $row['deadline']; ?></td>
            
			<td align="center">
			<a id="<?php echo $row['id']; ?>" class="edit-link" href="#" title="Edit">
			<img src="edit.png" width="20px" />
            </a></td>
			<td align="center"><a id="<?php echo $row['id']; ?>" class="delete-link" href="#" title="Delete">
			<img src="delete.png" width="20px" />
            </a></td>
			</tr>
			<?php
		}
		?>
        </tbody>
        </table>
        
        </div>

    </div>
    
    <br />
    
    <div class="container">
      
        <div class="alert alert-info" style="text-align:center">
        <a   href="Home.php">&copy;COPYRIGHT 2016 | DESIGN AND DEVELOPED BY TEAM CTE</a>
        </div>

    </div>
    

    
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/datatables.min.js"></script>
<script type="text/javascript" src="crud.js"></script>

<script type="text/javascript" charset="utf-8">
$(document).ready(function() {
	$('#example').DataTable();

	$('#example')
	.removeClass( 'display' )
	.addClass('table table-bordered');
});
</script>
</body>
</html>