<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     


        
        
//Call in bconverter.inc.php

include_once '../../php-includes/connect.inc.php'; 


function ChangeBNumber(){

if(isset($_POST['btn_submitBC'])){
        
            global $db;
  
    
    if (isset($_POST['txt_BC_OldBNub'])) {
        $var_BC_OLDBN = $_POST['txt_BC_OldBNub'];
    }

    if (isset($_POST['txt_BC_NewBNo'])) {
        $var_BC_NewBN = $_POST['txt_BC_NewBNo'];
    }
    
    if (isset($_POST['txt_BC_SubjID'])) {
        $var_BC_SubjID = $_POST['txt_BC_SubjID'];
    }

        
    
    $stmt = $db->prepare("UPDATE cp_subj_allo SET sa_batch_no='$var_BC_NewBN' WHERE `sa_batch_no`='$var_BC_OLDBN' AND `sa_subj_id`='$var_BC_SubjID' " );
    //i - integer / d - double / s - string / b - BLOB
    //$stmt->bind_param('issss', $var_AU_AutoID, $var_AU_username, $var_AU_Pass, $var_AU_Fname, $var_AU_Lname);
    $stmt->execute();
    $stmt->close(); 
    

     echo "<script>location='index.php?page=SubNPay&PageNo=1'</script>"; 
 
    return($stmt);
    
   }
   
    
 } 
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
    
?>