<?php
require_once 'connect.php';
 $exist=false;
	
	if($_POST)
	{
        
        
        $db=getDB();
        //###### Ajouter un nouveau devis debut ###### 
        if(isset($_POST['mynewdevis']))
        {
            
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
         $mycnib=isset($_POST['mycnib'])?$_POST['mycnib']:false;
            
            $request=$db->prepare("SELECT * FROM users");
            
        if(!$request->execute())
        {
            echo $request->errorInfo()[2];
        }
        else
        {
            while($res=$request->fetch())   // Verifier si la cnib exist deja 
            {
                if($res['carte_id']==$mycnib)
                {
                    $exist=true;
                    $due_ontable=$res['montant_due'];
                    $payee=$res['montant_paye'];
                    $id=$res['id'];
                    echo $id;
                    echo" ";
                    
                    echo" ";
                    echo $due_ontable;
                    break;   
                }
            }
        }
        
        
        
           
            
            $new_due=$total_montan+$due_ontable;
            $new_restant=$new_due-$payee;
            echo " ";
            echo $new_due;
            echo $total_montan;
            $edit=$db->prepare("UPDATE users SET montant_due=:new_due, montant_restant=:new_restant WHERE id=:id");
            $edit->bindParam(":new_due",$new_due);
            $edit->bindParam(":new_restant",$new_restant);
            $edit->bindParam(":id",$id);
            
            if(!$edit->execute())
            {
                echo $edit->errorInfo()[2];
                
            }
            else{
                echo "Le client existait deja mais la Modification est faites";
               
               // header("Location:Home.php");
          }
        
            //######### Devis de Mur Debut #################
            if($dev_cat=='devis_mur')
        {
           // echo $nombre_brique;
            try 
          {
                
            $req=$db->prepare("INSERT INTO devis_mur(user_id,nom_devis,ciment,sable,gravier,brique,main_doevre,montan_ciment,montan_sable,montan_gravier,montan_brique,total) VALUES(:devis_id, :devis_nom, :devis_ciment,:devis_sable, :devis_gravier, :devis_brique, :devis_oeuvre, :devis_mntcimt, :devis_mntsable, :devis_mntgravier, :devis_mntbrique, :devis_mnttotal)");
                //$req->bindParam(":table",$categorie_dev);
                $req->bindParam(":devis_id",$mycnib);
                $req->bindParam(":devis_nom",$nom_devis);
                $req->bindParam(":devis_ciment",$nombre_cimt);
                $req->bindParam(":devis_sable",$volume_sable);
                $req->bindParam(":devis_gravier",$volume_gravier);
                $req->bindParam(":devis_brique",$brique);
                $req->bindParam(":devis_oeuvre",$main_doeuvre);
                $req->bindParam(":devis_mntcimt",$montan_ciment);
                $req->bindParam(":devis_mntsable",$montan_sable);
                $req->bindParam(":devis_mntgravier",$montan_gravier);
                $req->bindParam(":devis_mntbrique",$montan_brique);
                $req->bindParam(":devis_mnttotal",$total_montan);
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
              // ############ Devis de Mur Fin ##################
            
             // ################ si devis est devis de crepissage debut ################
        else if($dev_cat=='devis_crepis') 
        {
            try
            {
                $req=$db->prepare("INSERT INTO devis_crepis(user_id,nom_devis,ciment,sable,gravier,main_doevre,montan_ciment,montan_sable,montan_gravier,total) VALUES(:devis_id, :devis_nom, :devis_ciment,:devis_sable, :devis_gravier, :devis_oeuvre, :devis_mntcimt, :devis_mntsable, :devis_mntgravier, :devis_mnttotal)");
                //$req->bindParam(":table",$categorie_dev);
                 $req->bindParam(":devis_id",$mycnib);
                $req->bindParam(":devis_nom",$nom_devis);
                $req->bindParam(":devis_ciment",$nombre_cimt);
                $req->bindParam(":devis_sable",$volume_sable);
                $req->bindParam(":devis_gravier",$volume_gravier);
                $req->bindParam(":devis_oeuvre",$main_doeuvre);
                $req->bindParam(":devis_mntcimt",$montan_ciment);
                $req->bindParam(":devis_mntsable",$montan_sable);
                $req->bindParam(":devis_mntgravier",$montan_gravier);
                $req->bindParam(":devis_mnttotal",$total_montan);
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
           // ####################Devis de crepisage fin ######################  
            
        }
        
        //### ajouter nouveau devis fin #####
        // ### ajouter un nouveau Client ###
        
      
        
	}

?>