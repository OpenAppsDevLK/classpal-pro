<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
        
//Call in addsubject.inc.php

include_once '../../php-includes/connect.inc.php'; 

function addsubject(){

if(isset($_POST['btn_AddSubj_submit'])){
    
    global $db;
 
    
    if (isset($_POST['txt_subjID'])) {
           $var_ID = $_POST['txt_subjID'];     
    }


    if (isset($_POST['txt_subj_name'])) {
        $var_Subj_Name =  $_POST['txt_subj_name'];
    }
    
    if (isset($_POST['txt_subj_fee'])) {
    $var_Subj_Fee = $_POST['txt_subj_fee'];
    }
    
    
       global $db;
    

    $stmt2 = $db->prepare("INSERT INTO `cp_subjects` (subj_id, subj_name, subj_classfee) VALUES (?, ?, ? )" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt2->bind_param('isd', $var_ID, $var_Subj_Name, $var_Subj_Fee);
    $stmt2->execute();
    $stmt2->close(); 
    
    $stmt3 = $stmt2;
    
       //Redirect to the page after inset 
   echo "<script>location='index.php?page=AddSubject'</script>";
   
    return($stmt3);
    
   }
    
  }  
    
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}


    
?>