<?php

 // Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];     

        
//Call in editsubject.inc.php

include_once '../../php-includes/connect.inc.php'; 

function updatesubject(){
     
 if (isset($_POST['txt_subj_id'])) {
        $var_ES_SubjID = $_POST['txt_subj_id'];
    }

    if (isset($_POST['txt_subj_name'])) {
        $var_ES_SubjName =  $_POST['txt_subj_name'];
    }
    
    if (isset($_POST['txt_subj_fee'])) {
    $var_ES_SubjFee = $_POST['txt_subj_fee'];
    }
    
       global $db;
    
    $stmt = $db->prepare("UPDATE cp_subjects SET subj_id=?, subj_name=?, subj_classfee=? WHERE `subj_id`='$var_ES_SubjID'" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('isd', $var_ES_SubjID, $var_ES_SubjName, $var_ES_SubjFee);
    $stmt->execute();
    $stmt->close(); 
    return($stmt);
    
   }
    
  
    
// If session isn't meet, user will redirect to login page
} else { 
    header('Location: ../login.php');
}

    
    
?>