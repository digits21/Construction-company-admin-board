<?php
class userClass
{
    //include("connect.php");
/* User Login */
public function userLogin($usernameEmail,$password)
{
    //echo"entered\n";
try{
   // echo"entered\n";
$db = getDB();
//$hash_password= hash('sha256', $password); //Password encryption 
    echo $usernameEmail;
    echo "\n";
    echo $password;
$stmt = $db->prepare("SELECT id FROM admin WHERE email=:usernameEmail AND password=:hash_password"); 
$stmt->bindParam("usernameEmail", $usernameEmail) ;
$stmt->bindParam("hash_password", $password) ;
    if(!$stmt->execute())
    {
        echo $stmt->errorInfo()[2];
}
    else 
    {
        
    

//$count=$stmt->rowCount();
   // echo $stmt; 
       
//$data=$stmt->fetch(PDO::FETCH_OBJ);
        while($data=$stmt->fetch())
        {
            
            if(!empty($data))
                
            {
                var_dump($data);
                $_SESSION['id']=$data['id'];
                return true;
                exit;
            }
            
            else
              {
              return false;
             } 
            
        }
         
          $db = null;
     }
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}

}
    
    /* User Details */
public function userDetails($uid)
{
try{
$db = getDB();
$stmt = $db->prepare("SELECT nom,prenom FROM admin WHERE id=:uid"); 
$stmt->bindParam("uid", $uid,PDO::PARAM_INT);
$stmt->execute();
$data = $stmt->fetch(PDO::FETCH_OBJ); //User data
return $data;
}
catch(PDOException $e) {
echo '{"error":{"text":'. $e->getMessage() .'}}';
}
}
    
}
?>