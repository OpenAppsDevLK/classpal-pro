<?php

// Browser Session Start here
session_start();
if(isset($_SESSION['user_id']) && isset($_SESSION['user_name'])){
	$user = $_SESSION['user_name'];
        
//Call in dailyclasses.inc.php

include_once '../../php-includes/connect.inc.php'; 


function adddailyclass(){
 
    if(isset($_POST['btn_submit'])){
        
     
    if (isset($_POST['txt_AutoID'])) {
        $var_AutoID = $_POST['txt_AutoID'];
    }

    if (isset($_POST['txt_class_name'])) {
        $var_Class_name = $_POST['txt_class_name'];
    }
    
    
    if (isset($_POST['txt_subj_name'])) {
        $var_Subj_name = $_POST['txt_subj_name'];
    }
    
    if (isset($_POST['txt_lect_name'])) {
        $var_Lect_name = $_POST['txt_lect_name'];
    }
  
    if (isset($_POST['txt_class_time'])) {
        $var_class_time = $_POST['txt_class_time'];
    }
 
    if (isset($_POST['txt_lect_name_confirm'])) {
        $var_lect_name_confirme = $_POST['txt_lect_name_confirm'];
    }    
       global $db;


    $stmt = $db->prepare("INSERT INTO `cp_dailyclasses` (dc_id, dc_class_name, dc_subj_id, dc_lec_id, dc_class_time, dc_lec_name) VALUES (?, ?, ?, ?, ?, ?)" );
    //i - integer / d - double / s - string / b - BLOB
    $stmt->bind_param('isiiss', $var_AutoID, $var_Class_name, $var_Subj_name, $var_Lect_name, $var_class_time, $var_lect_name_confirme);
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