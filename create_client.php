<?php
 //var_dump($_POST);
require_once 'connect.php';
$db=getDB();
  if(isset($_POST['save']))
        {
            
       
        
		$nom_client = isset($_POST['nom_cli'])?$_POST['nom_cli']:false;
		$prenom =isset($_POST['prenom_cli'])?$_POST['prenom_cli']:false;
		$tel = isset($_POST['tel_cli'])?$_POST['tel_cli']:false;
        $cnib=isset($_POST['carte_id'])?$_POST['carte_id']:false;
        $due=isset($_POST['total'])?$_POST['total']:false;
        $paye=isset($_POST['paye'])?$_POST['paye']:false;
       // $restant= isset($_POST['restant'])?$_POST['restant']:false;
        $date_debut=isset($_POST['date_deb'])?$_POST['date_deb']:false;
        $date_fin=isset($_POST['date_fin'])?$_POST['date_fin']:false;
        $save=isset($_POST['save'])?$_POST['save']:false;
        
        $nom_devis=isset($_POST['devis_nom'])?$_POST['devis_nom']:false;
        $categorie_dev=isset($_POST['categorie_devis'])?$_POST['categorie_devis']:false;
        $nombre_ciment=isset($_POST['nombre_ciment'])?$_POST['nombre_ciment']:false;
        $volume_sable=isset($_POST['volume_sable'])?$_POST['volume_sable']:false;
        $volume_gravier=isset($_POST['volume_gravier'])?$_POST['volume_gravier']:false;
        $nombre_brique=isset($_POST['nombre_brique'])?$_POST['nombre_brique']:false;
        $maindoeuvre=isset($_POST['maindoeuvre'])?$_POST['maindoeuvre']:false;
        $montan_brique=isset($_POST['montan_brique'])?$_POST['montan_brique']:false;
        $montan_ciment=isset($_POST['montant_ciment'])?$_POST['montant_ciment']:false;
        $montan_sable=isset($_POST['montan_sable'])?$_POST['montan_sable']:false;
        $montan_gravier=isset($_POST['montan_gravier'])?$_POST['montan_gravier']:false;
        
        $restant=$due-$paye;
        echo $nom_client;
        $request=$db->prepare("SELECT * FROM users");
        if(!$request->execute())
        {
            echo $request->errorInfo()[2];
        }
        else
        {
            while($res=$request->fetch())
            {
                if($res['carte_id']==$cnib)
                {
                    $exist=true;
                    $due_ontable=$res['montant_due'];
                    $paye_ontable=$res['montant_paye'];
                    $id=$res['id'];
                    echo $id;
                    echo" ";
                    echo $paye_ontable;
                    echo" ";
                    echo $due_ontable;
                    break;
                }
            }
        }
        
        if($exist)
        {
            echo "exist";
            
            $new_due=$due+$due_ontable;
            $new_paye=$paye+$paye_ontable;
            $new_restant=$new_due-$new_paye;
            $edit=$db->prepare("UPDATE users SET montant_due=:new_due, montant_paye=:new_paye, montant_restant=:new_restant WHERE id=:id");
            $edit->bindParam(":new_due",$new_due);
            $edit->bindParam(":new_paye",$new_paye);
            $edit->bindParam(":new_restant",$new_restant);
            $edit->bindParam(":id",$id);
            
            if(!$edit->execute())
            {
                echo $edit->errorInfo()[2];
                
            }
            else{
                echo "Le client existait deja mais la Modification est faites";
               
                header("Location:Home.php");
        }
        }
        else if(!$exist)
        {
            
        
		try{
			
            
			$stmt = $db->prepare("INSERT INTO users(nom,prenom,telephone,carte_id,montant_due,montant_paye,montant_restant,date_debut,deadline) VALUES(:cli_nom, :cli_prenom, :cli_tel, :cli_cnib, :cli_due, :cli_paye, :cli_restant, :cli_datedeb, :cli_deadline)");
			$stmt->bindParam(":cli_nom", $nom_client);
			$stmt->bindParam(":cli_prenom", $prenom);
			$stmt->bindParam(":cli_tel", $tel);
			$stmt->bindParam(":cli_cnib", $cnib);
            $stmt->bindParam(":cli_due", $due);
            $stmt->bindParam(":cli_paye", $paye);
            $stmt->bindParam(":cli_restant", $restant);
            $stmt->bindParam(":cli_datedeb", $date_debut);
            $stmt->bindParam(":cli_deadline", $date_fin);
			if($stmt->execute())
			{
				echo "Successfully Added";
			}
			else{
                echo $stmt->errorInfo()[2];
				echo "Query Problem";
			}	
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
        }
        if($categorie_dev=='devis_mur')
        {
           // echo $nombre_brique;
            try 
          {
                
            $req=$db->prepare("INSERT INTO devis_mur(user_id,nom_devis,ciment,sable,gravier,brique,main_doevre,montan_ciment,montan_sable,montan_gravier,montan_brique,total) VALUES(:devis_id, :devis_nom, :devis_ciment,:devis_sable, :devis_gravier, :devis_brique, :devis_oeuvre, :devis_mntcimt, :devis_mntsable, :devis_mntgravier, :devis_mntbrique, :devis_mnttotal)");
                //$req->bindParam(":table",$categorie_dev);
                $req->bindParam(":devis_id",$cnib);
                $req->bindParam(":devis_nom",$nom_devis);
                $req->bindParam(":devis_ciment",$nombre_ciment);
                $req->bindParam(":devis_sable",$volume_sable);
                $req->bindParam(":devis_gravier",$volume_gravier);
                $req->bindParam(":devis_brique",$nombre_brique);
                $req->bindParam(":devis_oeuvre",$maindoeuvre);
                $req->bindParam(":devis_mntcimt",$montan_ciment);
                $req->bindParam(":devis_mntsable",$montan_sable);
                $req->bindParam(":devis_mntgravier",$montan_gravier);
                $req->bindParam(":devis_mntbrique",$montan_brique);
                $req->bindParam(":devis_mnttotal",$due);
                if($req->execute())
                {
                    echo" done";
                    header("Location:Home.php");
                }
                else
                {
                    echo $req->errorInfo()[2];
                    //echo $nombre_brique;
                    
                    
                }
          }
            catch(PDOException $er)
            {
                echo $er->getMessage();
            }
            
        }
        else if($categorie_dev=='devis_crepis')
        {
            try
            {
                $req=$db->prepare("INSERT INTO devis_crepis(user_id,nom_devis,ciment,sable,gravier,main_doevre,montan_ciment,montan_sable,montan_gravier,total) VALUES(:devis_id, :devis_nom, :devis_ciment,:devis_sable, :devis_gravier, :devis_oeuvre, :devis_mntcimt, :devis_mntsable, :devis_mntgravier, :devis_mnttotal)");
                //$req->bindParam(":table",$categorie_dev);
                $req->bindParam(":devis_id",$cnib);
                $req->bindParam(":devis_nom",$nom_devis);
                $req->bindParam(":devis_ciment",$nombre_ciment);
                $req->bindParam(":devis_sable",$volume_sable);
                $req->bindParam(":devis_gravier",$volume_gravier);
                $req->bindParam(":devis_oeuvre",$maindoeuvre);
                $req->bindParam(":devis_mntcimt",$montan_ciment);
                $req->bindParam(":devis_mntsable",$montan_sable);
                $req->bindParam(":devis_mntgravier",$montan_gravier);
                $req->bindParam(":devis_mnttotal",$due);
                if($req->execute())
                {
                    echo" done";
                    header("Location:Home.php");
                }
                else
                {
                    echo $req->errorInfo()[2];
                    //echo $nombre_brique;
                    
                    
                }
            }
            catch(PDOException $err)
            {
                echo $err->getMessage();
            }
        }
    }

?>