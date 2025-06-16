<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];  
        
        
//Call in announcement.inc.php

include_once '../../php-includes/connect.inc.php'; 


function updateins(){
 
    if(isset($_POST['btn_Update_submit'])){
         
    if (isset($_POST['txt_InsAutoID'])) {
        $var_INSAutoID = $_POST['txt_InsAutoID'];
    }
    
    if (isset($_POST['txt_INS_Name'])) {
        $var_INS_Name = $_POST['txt_INS_Name'];
    }
  
       global $db;

    $stmt = $db->prepare("UPDATE cp_ins SET ins_id=?, ins_name=? WHERE `ins_id`='$var_INSAutoID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('is', $var_INSAutoID, $var_INS_Name);
    $stmt->execute();
    $stmt->close(); 

    return($stmt);
    
    
      }
      
   }
    
  
    
    // If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>